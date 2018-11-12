<?php

namespace app\components\prizeType;

use app\models\Prize;
use yii\base\Component;
use app\components\PrizeType;
use app\models\UsersPrizes;
use yii\web\User;

class GiftType extends PrizeType {

    /**
     * Get the prize
     *
     * @return array|null
     */
    public function get() {
        $model = Prize::find(['count', '>', 0])
            ->orderBy(new \yii\db\Expression('rand()'))
            ->limit(1)
            ->one();

        if(!$model) {
            // No gifts more
            return [
                'data' => [
                    'img' => null,
                    'description' => null,
                    'id' => -1
                ],
                'type' => 'prize'
            ];
        }

        $this->setData([
            'data' => [
                'img' => $model->img,
                'description' => $model->description,
                'id' => $model->id
            ],
            'type' => 'prize'
        ]);

        $model->count--;
        $model->save();

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