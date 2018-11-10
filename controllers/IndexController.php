<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class IndexController extends Controller
{
    public $defaultAction = 'index';

    /**
     * Get index page for logged user
     */
    public function actionIndexPage() {

    }
}
