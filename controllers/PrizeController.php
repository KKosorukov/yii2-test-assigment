<?php

namespace app\controllers;

use app\components\PrizeType;
use app\components\Roulette;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class PrizeController extends Controller
{
    /**
     * Spin the roulette and choose the prize for user
     */
    public function actionGet() {
        $roulette = new Roulette();
        $prize = $roulette->spin();
        $prizeData = $prize->get();
        $this->_addPrizeToUser($prize);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'success' => true,
            'data' => $prizeData
        ];
    }

    /**
     * Add prize to current user
     *
     * @param PrizeType $prize
     */
    private function _addPrizeToUser(PrizeType $prize) {

    }

    /**
     * Convert bonus into money
     */
    public function actionGetMoneyFromBonus() {

    }

    /**
     * Send money gift to account
     */
    public function actionSendMoneyToBankAccount() {

    }

    /**
     * Manual sending something by worker
     */
    public function actionSendGiftByPost() {

    }

    /**
     * Cancel from the choosed prize
     */
    public function actionPrizeCancel() {

    }
}
