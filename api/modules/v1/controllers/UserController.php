<?php

namespace api\modules\v1\controllers;

use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    /**
     * 行为: 登录认证
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                #这个地方使用`ComopositeAuth` 混合认证
                'class' => CompositeAuth::className(),
                #`authMethods` 中的每一个元素都应该是 一种 认证方式的类或者一个 配置数组
                'authMethods' => [
                    //HttpBasicAuth::className(),
                    //HttpBearerAuth::className(),
                    QueryParamAuth::className(), //url as: http://api.eleteam.com/v1/users?access-token=123
                ]
            ]
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();

        // 注销系统自带的实现方法, 才能重新实现
        unset($actions['delete'], $actions['view']);

        return $actions;
    }

    public function actionIsLoggedIn($user_id, $api_login_token)
    {
        $result = ['is_logged_in' => false];
        $user = User::findOne($user_id);
        if($user && $user->api_login_token && $user->api_login_token == $api_login_token){
            $result['is_logged_in'] = true;
        }
        return $result;
    }

    public function actionView($id)
    {
        $user = User::findOne($id);

        if($user) {
            unset($user->api_login_token);
        }

        return $user;
    }
}
