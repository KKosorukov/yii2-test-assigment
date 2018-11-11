<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class UsersPrizes extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users-prizes';
    }

    public function rules()
    {
        return [
            [['id', 'user_id', 'prize_id', 'num'], 'safe'],
        ];
    }
}