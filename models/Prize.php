<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Prize extends ActiveRecord {
    public $id;
    public $count;
    public $description;
    public $img;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prizes';
    }
}