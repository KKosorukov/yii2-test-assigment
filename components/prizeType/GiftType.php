<?php

namespace app\components\prizeType;

use app\models\Prize;
use yii\base\Component;
use app\components\PrizeType;
use app\models\UsersPrizes;
use yii\web\User;

class GiftType extends PrizeType {

    public function get() {
        // @TODO Here will be random choosing of prize model from DB

        $model = Prize::find()
            ->orderBy(new \yii\db\Expression('rand()'))
            ->limit(1)
            ->one();


        $this->setData([
            'data' => [
                'img' => $model->img,
                'description' => $model->description,
                'id' => $model->id
            ],
            'type' => 'prize'
        ]);

        return $this->prizeData;
    }

    /**
     * Add prize to user
     *
     * @param User $user
     */
    public function addTo(User $user) {
        $existUserPrize = UsersPrizes::findOne([
            'user_id' => $user->id,
            'prize_id' => $this->prizeData['data']['id']
        ]);

        if(!$existUserPrize){
            $newPrizeLink = new UsersPrizes();
            $newPrizeLink->user_id = $user->id;
            $newPrizeLink->prize_id = $this->prizeData['data']['id'];
            $newPrizeLink->num++;
            if(!$newPrizeLink->save()) {
                // @TODO Do something exceptional
            }
        } else {
            $existUserPrize->num++;
            if(!$existUserPrize->save()) {
                // @TODO Do something exceptional
            }
        }
    }
}