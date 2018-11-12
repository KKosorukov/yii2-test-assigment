<?php

namespace app\components\prizeType;

use app\models\LoyalityAccout;
use yii\base\Component;
use app\components\PrizeType;
use yii\web\User;


class LoyalityType extends PrizeType {

    const MAX_BONUS = 100;
    const MIN_BONUS = 5;

    public function get() {
        $bonusRand = rand(self::MIN_BONUS, self::MAX_BONUS);

        $this->setData([
            'data' => $bonusRand,
            'type' => 'bonus'
        ]);

        return $this->prizeData;
    }

    public function addTo(User $user) {
        $loyalityAccount = LoyalityAccout::findOne([
            'user_id' => $user->id
        ]);

        if(!$loyalityAccount){
           $loyalityAccount = new LoyalityAccout();
           $loyalityAccount->user_id = $user->id;
        }

        $loyalityAccount->sum += $this->prizeData['data'];
        if(!$loyalityAccount->save()) {
            // @TODO Do something exceiption
        }
    }
}