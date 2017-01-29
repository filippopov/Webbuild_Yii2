<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 29.1.2017 г.
 * Time: 18:02
 */

namespace frontend\controllers;


use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->isGuest ? '' : User::find()->where(['id' => Yii::$app->user->identity->getId()])->one();

        return $this->render('index', ['user' => $user]);
    }
}