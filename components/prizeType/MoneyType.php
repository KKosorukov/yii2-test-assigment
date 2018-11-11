<?php

namespace app\components\prizeType;

use yii\base\Component;
use app\components\PrizeType;

class MoneyType extends PrizeType {

    const MAX_MONEY = 50;
    const MIN_MONEY = 10;

    public function get() {
        $moneyRand = rand(self::MIN_MONEY, self::MAX_MONEY);

        $this->setData([
            'data' => $moneyRand,
            'type' => 'money'
        ]);

        return $moneyRand;
    }
}