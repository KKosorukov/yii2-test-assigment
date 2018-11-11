<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;

class IndexController extends Controller
{
    public $defaultAction = 'index';

    public $layout = 'demosite';

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index/login']);
        }

        return $this->render('index', [
            'user' => Yii::$app->user->identity
        ]);
    }

    /**
     * Get index page for logged user
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('auth', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['index/login']);
    }
}
