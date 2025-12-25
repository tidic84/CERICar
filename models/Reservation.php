<?php

namespace app\models;

use yii\db\ActiveRecord;

class Reservation extends ActiveRecord
{
    public static function tableName()
    {
        return "fredouil.reservation";
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
}
