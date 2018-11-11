<?php

use yii\db\Migration;
use yii\db\Schema;
use app\models\User;
use app\models\BankAccount;
use app\models\Bank;

/**
 * Class m181110_175059_create_base_tables
 */
class m181110_175059_create_base_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'password' => $this->string(),
            'authKey' => $this->string(),
            'accessToken' => $this->string()
        ]);

        $this->createTable('loyality_accounts', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'sum' => $this->integer()->defaultValue(0)
        ]);

        $this->createTable('prizes', [
            'id' => $this->primaryKey(),
            'count' => $this->integer()->defaultValue(10),
            'description' => $this->string()->defaultValue(null),
            'img' => $this->string()->defaultValue(null)
        ]);

        $this->createTable('users-prizes', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'prize_id' => $this->integer(),
            'num' => $this->integer()->defaultValue(0)
        ]);

        $this->createTable('bank_accounts', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'account_number' => $this->string()->defaultValue(null),
            'bank_id' => $this->integer()
        ]);

        $this->createTable('banks', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'provider' => $this->string()
        ]);

        $this->createTable('money', [
            'id' => $this->primaryKey(),
            'amount' => $this->integer()->defaultValue(10000)
        ]);

        $this->_fillTables();
    }

    /**
     * Fill Tables
     */
    private function _fillTables() {
        /**
         * Banks
         */
        $vtbBank = new Bank();
        $vtbBank->name = 'VTB24';
        $vtbBank->provider = 'VTB';
        $vtbBank->save();

        /**
         * Users
         */
        $firstUser = new User();
        $firstUser->username = 'admin';
        $firstUser->password = \Yii::$app->getSecurity()->generatePasswordHash('123456');
        $firstUser->save();

        /**
         * Bank account to user
         */
        $bankAccount = new BankAccount();
        $bankAccount->account_number = 'Bla-123-Bla-Bla-456';
        $bankAccount->user_id = $firstUser->id;
        $bankAccount->bank_id = $vtbBank->id;
        $bankAccount->save();

        /**
         * Prizes
         */
        $prizes  = [
            [
                'description' => 'Broccoli',
                'img' => 'https://4.imimg.com/data4/VX/BO/ANDROID-8994100/product-250x250.jpeg'
            ],
            [
                'description' => 'Box',
                'img' => 'https://bear-box.ru/45-home_default/korobochka-1.jpg'
            ],
            [
                'description' => 'Cat',
                'img' => 'https://pet-uploads.adoptapet.com/2/d/e/286204542.jpg'
            ]
        ];

        foreach ($prizes as $prize) {
            $newPrize = new \app\models\Prize();
            $newPrize->description = $prize['description'];
            $newPrize->img = $prize['img'];
            $newPrize->save();
        }

        /**
         * Money
         */
        $newMoneyPeriod = new \app\models\Money();
        $newMoneyPeriod->amount = 10000;
        $newMoneyPeriod->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('loyality_accounts');
        $this->dropTable('prizes');
        $this->dropTable('users-prizes');
        $this->dropTable('bank_accounts');
        $this->dropTable('banks');
        $this->dropTable('money');
    }
}
