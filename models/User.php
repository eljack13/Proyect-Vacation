<?php

namespace app\models;

use Yii;

class User extends TblRegistroPersonal implements \yii\web\IdentityInterface
{
    //public $id;
    //public $username;
    //spublic $password;
    public $authKey;
    public $accessToken;

  

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['tbl_registro_personal_id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
      /*  foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;
        */
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['tbl_registro_personal_correo' => $username]);  
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->tbl_registro_personal_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
      //  return $this->password === $password;
      return Yii::$app->runAction('security/security/validatepassword', [
        'pwdToValidate' => $password, 
        'pwdStored' => $this->tbl_registro_personal_contraseña
    ]);
    }
}
