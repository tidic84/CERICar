<?php

namespace app\models;

use yii\db\ActiveRecord;
use ErrorException;

class Internaute extends ActiveRecord
{
    public static function tableName()
    {
        return "fredouil.internaute";
    }

    public function rules()
    {
        return [
                // [['name', 'email'], 'required'],
                // [['email'], 'email'],
                // [['name'], 'string', 'max' => 255],
            ];
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
        return $this->pseudo;
    }

    public static function getInternauteByPseudo($pseudo)
    {
        $internaute = self::find()
            ->where(["pseudo" => $pseudo])
            ->one();
        if (!$internaute) {
            throw new ErrorException(
                "Le pseudo \"" .
                    $pseudo .
                    "\" ne correspond a aucun internaute.",
            );
        }
        return $internaute;
    }

    public function getVoyagesProposes()
    {
        return $this->hasMany(Voyage::class, ["conducteur" => "id"]);
    }

    public function getReservations()
    {
        return $this->hasMany(Reservation::class, ["voyageur" => "id"]);
    }

    // Méthode demandé
    public static function getUserByIdentifiant($internauteId)
    {
        return self::findOne($internauteId);
    }
    // Meme méthode mais avec un nom plus cohérant
    public static function getInternauteById($internauteId)
    {
        return self::findOne($internauteId);
    }
}
