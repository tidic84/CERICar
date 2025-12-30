<?php

namespace app\models;

use yii\db\ActiveRecord;

class Ville extends ActiveRecord
{
    public static function tableName()
    {
        return "uapv2400993.ville";
    }

    public function rules()
    {
        return [];
    }

    public function __toString()
    {
        return $this->image;
    }
}
