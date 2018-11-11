<?php

use yii\db\Migration;
use yii\db\Schema;
use app\models\User;
use yii;

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
            'name' => $this->string()
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
         * Users
         */

        $firstUser = new User();
        $firstUser->username = 'admin';
        $firstUser->password = Yii::$app->getSecurity()->generatePasswordHash('123456');
        $firstUser->save();

        /**
         * Prizes
         */

        /**
         * Money
         */
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
