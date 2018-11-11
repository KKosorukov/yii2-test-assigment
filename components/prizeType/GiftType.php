<?php

namespace app\components\prizeType;

use app\models\Prize;
use yii\base\Component;
use app\components\PrizeType;

class GiftType extends PrizeType {

    public function get() {
        // @TODO Here will be random choosing of prize model from DB

        $model = Prize::find()
            ->orderBy(new \yii\db\Expression('rand()'))
            ->limit(1)
            ->one();


        $this->setData([
            'data' => [
                $model->img,
                $model->description
            ],
            'type' => 'prize'
        ]);

        return $model;
    }
}