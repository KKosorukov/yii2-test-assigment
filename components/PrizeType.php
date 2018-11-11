<?php

namespace app\components;

use app\models\UsersPrizes;
use yii\base\Component;
use app\models\User;

abstract class PrizeType extends Component {
    protected $prizeData = null;

    public function setData($data) {
        $this->prizeData = $data;
    }
}