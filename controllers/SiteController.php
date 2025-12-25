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
        return $this->render("index");
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
        $internautes = Internaute::find()->all();
        $marqueVehicules = MarqueVehicule::find()->all();
        $reservations = Reservation::find()->all();
        $trajets = Trajet::find()->all();
        $typeVehicules = TypeVehicule::find()->all();
        $voyages = Voyage::find()->all();

        // Préparer les données supplémentaires
        $getTrajet = Trajet::getTrajet("Amiens", "Marseille");
        $getVoyages = Voyage::getVoyagesByTrajetId(5);
        $getInternaute = Internaute::getInternauteByPseudo("Fourmi");

        return $this->render("mapage", [
            "internautes" => $internautes,
            "marqueVehicules" => $marqueVehicules,
            "reservations" => $reservations,
            "trajets" => $trajets,
            "typeVehicules" => $typeVehicules,
            "voyages" => $voyages,
            "getTrajet" => $getTrajet,
            "getVoyages" => $getVoyages,
            "getInternaute" => $getInternaute,
        ]);
    }
}
