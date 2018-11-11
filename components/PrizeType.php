<?php

namespace app\components;

use yii\base\Component;

abstract class PrizeType extends Component {
    private $prizeData = null;

    public function setData($data) {
        $this->prizeData = $data;
    }
}