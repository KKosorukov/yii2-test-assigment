<?php

namespace app\controllers;

use app\components\BankConnector;
use app\components\PrizeType;
use app\components\prizeType\LoyalityType;
use app\components\prizeType\MoneyType;
use app\components\Roulette;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\UsersPrizes;
use yii\filters\ContentNegotiator;

class PrizeController extends Controller
{
    const K = 1.5;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ]

        ];

        return $behaviors;
    }

    /**
     * Spin the roulette and choose the prize for user
     */
    public function actionGet() {
        $roulette = new Roulette();
        $prize = $roulette->spin();
        $prizeData = $prize->get();
        $prize->addTo(\Yii::$app->user);

        return [
            'success' => true,
            'data' => $prizeData
        ];
    }

    /**
     * Convert bonus into money
     */
    public function actionGetbonusfrommoney() {
        $params = \Yii::$app->request->bodyParams;
        if(isset($params['money'])) {
            $bonus = self::K * $params['money'];

            $loyality = new LoyalityType();
            $loyality->setData([
                'type' => 'bonus',
                'data' => $bonus
            ]);


            $loyality->addTo(\Yii::$app->user);

            return [
                'success' => true,
                'bonus' => $bonus
            ];
        }

        return [
            'success' => false,
        ];
    }

    /**
     * Send prize (money or gift
     */
    public function actionSend() {
        $params = \Yii::$app->request->bodyParams;

        if(!isset($params['type'])) {
            return [
                'success' => false
            ];
        }

        switch($params['type']) {
            case 'prize' :
                // @TODO Manual, by postman...
            break;
            case 'money' :
                $bankName = \Yii::$app->user->identity->bank->provider;
                $classname = "\\app\\components\\banks\\".$bankName;
                (new $classname())->sendMoney();
            break;
            default: return ['success' => false];
        }

        return [
            'success' => true
        ];
    }

    /**
     * Cancel from the choosed prize
     */
    public function actionCancel() {
        // @TODO Here should be access filter. Action is not for guests.
        $params = \Yii::$app->request->bodyParams;
        if(!isset($params['id'])) {
            return [
                'success' => false
            ];
        }

        $usersPrize = UsersPrizes::find()->where([
            'user_id' => \Yii::$app->user->id,
            'prize_id' => $params['id']
        ])->one();

        if($usersPrize) {
            $usersPrize->cancelFromUser();
        }

        return [
            'success' => true
        ];
    }
}
