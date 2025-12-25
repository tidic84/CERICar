<?php

namespace app\models;

use yii\db\ActiveRecord;

class TypeVehicule extends ActiveRecord
{
    public static function tableName()
    {
        return "fredouil.typevehicule";
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
    //
    public function __toString()
    {
        return $this->typev;
    }
}
