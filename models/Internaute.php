<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use ErrorException;

class Internaute extends ActiveRecord implements IdentityInterface
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

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return md5($this->id . $this->pseudo . $this->mail);
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function login($duration = 0)
    {
        return Yii::$app->user->login($this, $duration);
    }

    public static function logout()
    {
        return Yii::$app->user->logout();
    }

    public static function getCurrentUser()
    {
        return Yii::$app->user->identity;
    }

    public static function isLoggedIn()
    {
        return !Yii::$app->user->isGuest;
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
