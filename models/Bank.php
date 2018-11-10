<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Bank extends ActiveRecord {
    public $id;
    public $name;

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