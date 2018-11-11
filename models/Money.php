<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Money extends ActiveRecord {
    public $id;
    public $amount;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'money';
    }
}