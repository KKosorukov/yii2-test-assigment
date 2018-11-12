<?php

namespace app\components\banks;

use yii\base\Component;
use app\components\BankConnector;

class VTB extends BankConnector {

    /**
     * Send money via VTB
     */
    public function sendMoney() {
        // @TODO Do something
        echo 'VTB';
        parent::sendMoney();
    }
}