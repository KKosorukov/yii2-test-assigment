<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Prize extends ActiveRecord {

    public function rules()
    {
        return [
            [['id', 'count', 'description', 'img'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prizes';
    }
}