<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Money extends ActiveRecord {
    public function rules()
    {
        return [
            [['id', 'amount'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'money';
    }
}