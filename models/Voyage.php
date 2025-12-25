<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Internaute;
use app\models\Trajet;
use ErrorException;

class Voyage extends ActiveRecord
{
    public static function tableName()
    {
        return "fredouil.voyage";
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

    public function __toString()
    {
        return "{ " .
            $this->id .
            ", " .
            $this->conducteur .
            ", " .
            Trajet::findOne($this->trajet) .
            " }";
    }

    public static function getVoyagesByTrajetId($trajetId)
    {
        $trajet = Trajet::findOne($trajetId);
        if ($trajet) {
            $voyages = self::find()
                ->where(["trajet" => $trajet->id])
                ->all();
            return $voyages;
        } else {
            throw new ErrorException(
                "Le trajet \"" . $trajetId . "\" n'existe pas.",
            );
        }
    }

    public static function arrayToString($array)
    {
        $result = "[ ";
        foreach ($array as $item) {
            $result .= $item . ",\n";
        }
        $result .= " ]";
        return $result;
    }
}
