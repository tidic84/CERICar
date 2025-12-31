<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use ErrorException;

class Internaute extends ActiveRecord
{
    public $password_plain;
    public $password_confirm;
    public $cgu;

    public static function tableName()
    {
        return "fredouil.internaute";
    }

    public function rules()
    {
        return [
            [['prenom', 'nom', 'pseudo', 'mail'], 'required', 'message' => '{attribute} est requis'],
            [['password_plain'], 'required', 'on' => 'register'],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password_plain', 'message' => 'Les mots de passe ne correspondent pas'],

            [['mail'], 'email'],
            [['mail'], 'unique', 'message' => 'Cet email est déjà utilisé'],
            [['pseudo'], 'unique', 'message' => 'Ce pseudo est déjà utilisé'],
            [['cgu'], 'required', 'requiredValue' => 1, 'on' => 'register'],
            [['photo'], 'string'],

        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert && $this->password_plain) {
                $this->pass = sha1($this->password_plain);
            }
            return true;
        }
        return false;
    }

    public function __toString()
    {
        return $this->pseudo;
    }

    public function getVoyagesProposes()
    {
        return $this->hasMany(Voyage::class, ["conducteur" => "id"]);
    }

    public function getReservations()
    {
        return $this->hasMany(Reservation::class, ["voyageur" => "id"]);
    }

    public function getProfilePicture() {
        if(!$this->photo) {
            $num = abs(crc32($this->pseudo)) % 100;
            return "https://avatar.iran.liara.run/public/" . $num;
        }
        return $this->photo;
    }

    // Méthode demandé
    public static function getUserByIdentifiant($pseudo)
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
    // Meme méthode mais avec un nom plus cohérant
    public static function getInternauteByPseudo($pseudo)
    {
        $internaute = self::find()
            ->where(["pseudo" => $pseudo])
            ->one();
        return $internaute;
    }

    public function validatePassword($password)
    {
        return $this->pass === sha1($password);
    }

    public function login()
    {
        Yii::$app->session->set('internaute_id', $this->id);
    }

    public static function logout()
    {
        Yii::$app->session->remove('internaute_id');
    }

    public static function getCurrentUser()
    {
        $userId = Yii::$app->session->get('internaute_id');
        if ($userId) {
            return self::findOne($userId);
        }
        return null;
    }

    public static function isLoggedIn()
    {
        return Yii::$app->session->has('internaute_id');
    }

    public function errorsToString() {
        $res = "";
        foreach($this->errors as $attribute => $messages) {
            foreach($messages as $message) {
                $res .= $message . "\n";
            }
        }
        return $res;
    }
}
