<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Voyage;
use app\models\Internaute;
use ErrorException;

class Reservation extends ActiveRecord
{
    public function getVoyageObj()
    {
        return $this->hasOne(Voyage::class, ["id" => "voyage"]);
    }

    public function getVoyageurObj()
    {
        return $this->hasOne(Internaute::class, ["id" => "voyageur"]);
    }
    public static function tableName()
    {
        return "fredouil.reservation";
    }

    public static function getReservationsByVoyageId($voyageId)
    {
        $voyage = Voyage::findOne($voyageId);
        if (!$voyage) {
            return null;
        }

        return self::find()
            ->where(["voyage" => $voyageId])
            ->all();
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

    public function __toString()
    {
        return "{ id: " .
            $this->id .
            ", voyage: " .
            $this->voyageObj .
            ", voyageur: " .
            $this->voyageurObj .
            ", nbplaceresa: " .
            $this->nbplaceresa;
    }
}
