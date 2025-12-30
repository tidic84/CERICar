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

        if($depart && $arrivee) {
            $trajet = Trajet::getTrajet($depart, $arrivee);
            if($trajet) {
                $voyages = Voyage::getVoyagesByTrajetId($trajet->id);
            }
        }

        return $this->render('index', [
            'voyages' => $voyages,
            'nbpersonnes' => $nbpersonnes,
            'depart' => $depart,
            'arrivee' => $arrivee,
        ]);
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
