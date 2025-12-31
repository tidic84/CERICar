<?php

namespace app\models;

use yii\db\ActiveRecord;

class MarqueVehicule extends ActiveRecord
{
    public static function tableName()
    {
        return "fredouil.marquevehicule";
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
        return $this->marquev;
    }
}
