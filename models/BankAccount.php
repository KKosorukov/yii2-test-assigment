<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class BankAccount extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_accounts';
    }

    public function rules()
    {
        return [
            [['id', 'user_id', 'account_number', 'bank_id'], 'safe'],
        ];
    }

    /**
     * Has one bank
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBank() {
        return $this->hasOne(Bank::className(), [
            'bank_id' => 'id'
        ]);
    }

    /**
     * Has one user
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), [
            'user_id' => 'id'
        ]);
    }
}