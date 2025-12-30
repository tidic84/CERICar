<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

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
            'arrivee' => $arrivee,
        ]);
    }

    public function actionRechercheVoyages() {
        // Désactiver le layout et forcer le format JSON
        $this->layout = false;
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Désactiver les behaviors potentiellement problématiques pour cette action
        $this->enableCsrfValidation = false;

        $depart = Yii::$app->request->get('depart');
        $arrivee = Yii::$app->request->get('arrivee');
        $nbpersonnes = Yii::$app->request->get('nbpersonnes', 1);
        $voyages = [];

        if($depart && $arrivee) {
            try {
                $trajet = Trajet::getTrajet($depart, $arrivee);
                if($trajet) {
                    $voyagesObjs = Voyage::getVoyagesByTrajetId($trajet->id);

                    // Convertir les objets en tableaux avec toutes les données nécessaires
                    foreach($voyagesObjs as $voyage) {
                        $placesRestantes = $voyage->getPlacesRestantes();

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

        // Retourner directement le tableau - Yii2 le convertira en JSON
        return [
            'success' => true,
            'voyages' => $voyages,
            'nbpersonnes' => $nbpersonnes
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

    /**
     * Displays TailwindCSS example page.
     *
     * @return string
     */
    public function actionExempleTailwind()
    {
        return $this->render("exemple-tailwind");
    }

    /**
     * Displays home page with pop design.
     *
     * @return string
     */
    public function actionHomePop()
    {
        // Désactiver le layout par défaut pour cette page qui a son propre style
        $this->layout = false;
        return $this->render("home-pop");
    }
}
