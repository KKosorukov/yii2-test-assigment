<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class UsersPrizes extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users-prizes';
    }

    public function rules()
    {
        return [
            [['id', 'user_id', 'prize_id', 'num'], 'safe'],
        ];
    }

    /**
     * Cancel prize from user: if prize is only one, delete it. Otherwise, count -= 1
     */
    public function cancelFromUser() {
        if($this->num == 1) {
            $this->delete();
        } else {
            $this->num--;
            if(!$this->save()) {
                // @TODO Something exceptional..
            }

            // This part can be in another model, but... This is "transaction"
            $prize = Prize::findOne($this->prize_id);
            if($prize) {
                $prize->count++;
                $prize->save();
            }
        }
    }
}