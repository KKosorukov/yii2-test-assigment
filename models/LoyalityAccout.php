<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class LoyalityAccout extends ActiveRecord {
    public function rules()
    {
        return [
            [['id', 'user_id', 'sum'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loyality_accounts';
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