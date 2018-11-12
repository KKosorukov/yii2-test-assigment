<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin([
    'id' => 'logout-form',
    'layout' => 'horizontal',
    'action' => '/index/logout'
]); ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Logout', ['class' => 'btn btn-primary', 'name' => 'logout-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>


<h1>Roulette spinner!</h1>
<h2>Hi, <?=$user->username ?>!</h2>

<?= Html::submitButton('Spin the roulette!', ['class' => 'btn btn-primary', 'name' => 'spin-btn', 'id' => 'spin-btn']) ?>

<div class="row">
    <div class="col-md-4" id="prizeCont"></div>
    <div class="col-md-4" id="prizeDescription"></div>
</div>
