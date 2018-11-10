<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class BankAccount extends ActiveRecord {
    public $id;
    public $user_id;
    public $account_number;
    public $bank_id;

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