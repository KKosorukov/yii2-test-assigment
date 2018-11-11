<?php

namespace app\components\prizeType;

use app\models\Money;
use yii\base\Component;
use app\components\PrizeType;
use yii\web\User;

class MoneyType extends PrizeType {

    const MAX_MONEY = 50;
    const MIN_MONEY = 10;

    public function get() {
        $moneyModel = Money::find()->orderBy('id', 'DESC')->limit(1)->one();

        if($moneyModel->amount == 0) {
            // No money - no honey
            return [
              'data' => 0,
              'type' => 'money'
            ];
        }

        $moneyRand = rand(self::MIN_MONEY, self::MAX_MONEY);

        if($moneyModel->amount - $moneyRand < 0) {
            $moneyModel->amount = 0;
        } else {
            $moneyModel->amount -= $moneyRand;
        }

        if(!$moneyModel->save()) {
            // @TODO Do exception, for instance
        }

        $this->setData([
            'data' => $moneyRand,
            'type' => 'money'
        ]);

        return $this->prizeData;
    }

    public function addTo(User $user) {

    }
}