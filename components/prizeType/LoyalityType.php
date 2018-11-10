<?php

namespace app\components\prizeType;

use yii\base\Component;
use app\components\PrizeType;

class LoyalityType extends PrizeType {

    const MAX_BONUS = 100;
    const MIN_BONUS = 5;

    public function get() {
        $bonusRand = rand(self::MIN_BONUS, self::MAX_BONUS);
        return $bonusRand;
    }
}