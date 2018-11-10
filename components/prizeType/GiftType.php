<?php

namespace app\components\prizeType;

use yii\base\Component;
use app\components\PrizeType;

class GiftType extends PrizeType {

    public function get() {
        // @TODO Here will be random choosing of prize model from DB
        $model = null;
        return $model;
    }
}