<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Bank extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banks';
    }

    public function rules()
    {
        return [
            [['id', 'name', 'provider'], 'safe'],
        ];
    }

    /**
     * Has many accounts
     *
     * @return mixed
     */
    public function getAccounts() {
        return $this->hasMany(BankAccount::className(), [
            'id' => 'bank_id'
        ]);
    }
}