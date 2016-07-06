<?php

namespace api\modules\v1\controllers;

use common\models\LoginForm;
use Yii;
use yii\rest\Controller;

class AuthController extends Controller
{
    /**
     * api登录, 返回access-token值
     * @return LoginForm|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            return Yii::$app->user->identity->getAuthKey();
        } else {
            return $model;
        }
    }

    /**
     * api退出, 前期退出不更新access-token, 任何平台都可以登录用户的账号,便于调试,而且不会导致用户登录的token失效
     * 后期如果要实现单点登录时,则清空用户的token即可
     * @return bool
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return true;
    }
}