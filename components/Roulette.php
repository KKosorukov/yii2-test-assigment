<?php

namespace app\components;

use yii\base\Component;

use app\components\prizeType\GiftType;
use app\components\prizeType\LoyalityType;
use app\components\prizeType\MoneyType;

class Roulette extends Component {

    /**
     * Spin the roulette
     */
    public function spin() {
        $numRand = rand(0, 2);
        $prize = null;
        $choosed = [
            MoneyType::class, // Money
            LoyalityType::class, // Loyality bonus
            GiftType::class // Prize bonus
        ][$numRand];

        return new $choosed;
    }
}