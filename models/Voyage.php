<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Internaute;
use app\models\Trajet;

class Voyage extends ActiveRecord
{
    public static function tableName()
    {
        return "fredouil.voyage";
    }

    public function getPrix($nbpersonnes) {
        return $this->tarif * $this->trajetObj->distance * $nbpersonnes;
    }

    public function getFormatHeureDeDepart() {
        $heuredepartformat;
        $heure = $this->heuredepart;
        if($heure<10) {
            $heuredepartformat = "0". $heure . "h00";
        } else {
            $heuredepartformat = $heure . "h00";
        }
        return $heuredepartformat;
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
        return "{ id: " .
            $this->id .
            ", conducteur: " .
            $this->conducteurObj .
            ", Trajet: " .
            $this->trajetObj .
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
            return null;
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

    public function getConducteurObj()
    {
        return $this->hasOne(Internaute::class, ["id" => "conducteur"]);
    }

    public function getTrajetObj()
    {
        return $this->hasOne(Trajet::class, ["id" => "trajet"]);
    }

    public function getMarqueVehiculeObj()
    {
        return $this->hasOne(MarqueVehicule::class, ["id" => "marquevehicule"]);
    }

    public function getTypeVehiculeObj()
    {
        return $this->hasOne(TypeVehicule::class, ["id" => "typevehicule"]);
    }

    public function getReservations()
    {
        return $this->hasMany(Reservation::class, ["voyage" => "id"]);
    }
}
