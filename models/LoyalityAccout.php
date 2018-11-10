<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class LoyalityAccout extends ActiveRecord {
    public $id;
    public $user_id;
    public $sum;

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