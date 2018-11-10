<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\BankAccount;
use app\models\LoyalityAccout;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    /**
     * Has one bank account
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBank() {
        return $this->hasOne(BankAccount::className(), [
            'id' => 'user_id'
        ]);
    }

    /**
     * Has one loyality account
     */
    public function getLoyality() {
        return $this->hasOne(LoyalityAccount::className(), [
            'id' => 'user_id'
        ]);
    }

    /**
     * Has many prizes
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrizes() {
        return $this->hasMany(Prize::className(), ['id'  => 'user_id'])
            ->viaTable('users-prizes', ['prize_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
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
        return $this->password === $password;
    }
}
