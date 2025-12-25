<?php

namespace app\models;

use yii\db\ActiveRecord;
use ErrorException;

class Trajet extends ActiveRecord
{
    public static function tableName()
    {
        return "fredouil.trajet";
    }

    public function rules()
    {
        return [];
    }

    // public function attributeLabels()
    // {
    //     return [
    //         'id' => 'ID',
    //         'name' => 'Name',
    //         'email' => 'Email',
    //     ];
    // }

    public static function getTrajet($villeDepart, $villeArrive)
    {
        if (
            !self::find()
                ->where(["depart" => $villeDepart])
                ->one()
        ) {
            throw new ErrorException(
                "La ville \"" .
                    $villeDepart .
                    "\" n'existe pas dans la base de donnée.",
            );
        }
        if (
            !self::find()
                ->where(["arrivee" => $villeArrive])
                ->one()
        ) {
            throw new ErrorException(
                "La ville \"" .
                    $villeArrive .
                    "\" n'existe pas dans la base de donnée.",
            );
        }

        return self::find()
            ->where(["depart" => $villeDepart, "arrivee" => $villeArrive])
            ->one();
    }

    public function __toString()
    {
        return $this->depart .
            "->" .
            $this->arrivee .
            ": " .
            $this->distance .
            "km";
    }
}
