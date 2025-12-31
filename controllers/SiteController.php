<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\Controller;

use app\models\Internaute;
use app\models\MarqueVehicule;
use app\models\Reservation;
use app\models\Trajet;
use app\models\TypeVehicule;
use app\models\Voyage;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            "access" => [
                "class" => AccessControl::class,
                "only" => ["logout"],
                "rules" => [
                    [
                        "actions" => ["logout"],
                        "allow" => true,
                        "roles" => ["@"],
                    ],
                ],
            ],
            "verbs" => [
                "class" => VerbFilter::class,
                "actions" => [
                    "logout" => ["post"],
                    "logout-ajax" => ["post"],
                    "login-submit" => ["post"],
                    "register-submit" => ["post"],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            "error" => [
                "class" => "yii\web\ErrorAction",
            ],
            "captcha" => [
                "class" => "yii\captcha\CaptchaAction",
                "fixedVerifyCode" => YII_ENV_TEST ? "testme" : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // Définir currentUser dans les paramètres de la vue
            $this->view->params['currentUser'] = Internaute::getCurrentUser();
            $this->view->params['isLoggedIn'] = Internaute::isLoggedIn();
            return true;
        }
        return false;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $depart = Yii::$app->request->get('depart');
        $arrivee = Yii::$app->request->get('arrivee');
        $nbpersonnes = Yii::$app->request->get('nbpersonnes');
        $voyages = null;

        // if($depart && $arrivee) {
        //     $trajet = Trajet::getTrajet($depart, $arrivee);
        //     if($trajet) {
        //         $voyages = Voyage::getVoyagesByTrajetId($trajet->id);
        //     }
        // }
        return $this->render('index', [
            'voyages' => $voyages,
            'nbpersonnes' => $nbpersonnes,
            'depart' => $depart,
            'arrivee' => $arrivee
        ]);
    }

    public function actionRechercheVoyages() {
        $this->layout = false;
        Yii::$app->response->format = Response::FORMAT_JSON;

        $depart = Yii::$app->request->get('depart');
        $arrivee = Yii::$app->request->get('arrivee');
        $nbpersonnes = Yii::$app->request->get('nbpersonnes', 1);
        $voyages = [];
        $nbVoyages = 0;

        if($depart && $arrivee) {
            try {
                $trajet = Trajet::getTrajet($depart, $arrivee);
                if($trajet) {
                    $voyagesObjs = Voyage::getVoyagesByTrajetId($trajet->id);

                    foreach($voyagesObjs as $voyage) {
                        $placesRestantes = $voyage->getPlacesRestantes();
                        $nbVoyages++;
                        $voyages[] = [
                            'id' => $voyage->id,
                            'depart' => $voyage->trajetObj->depart,
                            'arrivee' => $voyage->trajetObj->arrivee,
                            'arriveeImg' => $voyage->trajetObj->arriveeImg(),
                            'heureDepart' => $voyage->getFormatHeureDeDepart(),
                            'prix' => $voyage->getPrix($nbpersonnes),
                            'conducteurNom' => (string)$voyage->conducteurObj,
                            'conducteurPhoto' => $voyage->conducteurObj->getProfilePicture(),
                            'placesRestantes' => $placesRestantes,
                            'nbPlacesDispo' => $voyage->nbplacedispo,
                        ];
                    }
                }
            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
        }

        $pluriel = $nbVoyages > 1 ? 's' : '';
        return [
            'success' => true,
            'voyages' => $voyages,
            'nbpersonnes' => $nbpersonnes,
            'message' => $nbVoyages . " voyage". $pluriel . " trouvé" . $pluriel . " pour " . $depart . " → " . $arrivee,
        ];
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render("about");
    }

    public function actionRegister()
    {
        return $this->render("register");
    }

    public function actionLogin()
    {
        return $this->render("login");
    }

    public function actionLogout()
    {
        Internaute::logout();
        return $this->redirect(['site/index']);
    }

    public function actionLogoutAjax()
    {
        $this->layout = false;
        Yii::$app->response->format = Response::FORMAT_JSON;

        Internaute::logout();

        return [
            'success' => true,
            'message' => 'Déconnexion réussie ! À bientôt !',
            'redirect' => Yii::$app->urlManager->createUrl(['site/index']),
        ];
    }

    public function actionLoginSubmit()
    {
        $this->layout = false;
        Yii::$app->response->format = Response::FORMAT_JSON;

        $pseudo = Yii::$app->request->post("identifiant");
        $password = Yii::$app->request->post("password");
        $remember = Yii::$app->request->post("remember");

        if(!$pseudo || !$password) {
            return [
                'success' => false,
                'message' => "Veuillez remplir tous les champs.",
            ];
        }

        $user = Internaute::getInternauteByPseudo($pseudo);

        if (!$user || !$user->validatePassword($password)) {
            return [
                'success' => false,
                'message' => "Identifiant ou mot de passe incorrect.",
            ];
        }

        $user->login();

        return [
            'success' => true,
            'message' => "Connexion réussie ! Bienvenue " . $user->prenom . " !",
            'redirect' => Yii::$app->urlManager->createUrl(['site/index']),
        ];
    }

    public function actionRegisterSubmit()
    {
        $this->layout = false;
        Yii::$app->response->format = Response::FORMAT_JSON;

        $user = new Internaute();

        $user->prenom = Yii::$app->request->post("prenom");
        $user->nom = Yii::$app->request->post("nom");
        $user->pseudo = Yii::$app->request->post("pseudo");
        $user->mail = Yii::$app->request->post("email");
        $user->password_plain = Yii::$app->request->post("password");
        $user->password_confirm = Yii::$app->request->post("passwordConfirm");
        $user->photo = Yii::$app->request->post("photo");
        $user->cgu = Yii::$app->request->post("cgu");
        $user->photo = Yii::$app->request->post("photo");
        if(Yii::$app->request->post("permis") == 1) {
            $user->permis = $numeroPermis;
        }

        if ($user->save()) {
            return [
                'success' => true,
                'message' => "Inscription réussie ! Bienvenue " . $user->prenom . " !",
                'redirect' => Yii::$app->urlManager->createUrl(['site/index']),
            ];
        } else {
            return [
                'success' => false,
                'message' => "Erreur : " . $user->errorsToString(),
            ];
        }
    }

    public function actionMapage()
    {
        $test = Internaute::getUserByIdentifiant("Fourmi");
        $internaute = Internaute::getUserByIdentifiant("Chat");

        $voyagesProposes = null;
        if ($internaute->permis) {
            $voyagesProposes = $internaute->voyagesProposes;
        }

        $reservations = $internaute->reservations;

        return $this->render("mapage", [
            "internaute" => $internaute,
            "voyagesProposes" => $voyagesProposes,
            "reservations" => $reservations,
            "test" => $test,
        ]);
    }
}
