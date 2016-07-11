<?php

namespace api\modules\v1\controllers;

use common\components\ETRestController;
use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\validators\Validator;

class UserController extends ETRestController
{
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

    public function actionView($id)
    {
        $user = User::findOne($id);
        return $this->jsonSuccess(['user'=>$user->toArray()]);
    }

    public function registerStep1($mobile)
    {
        if(strlen($mobile)<11){
            return $this->jsonFail([], '手机号格式不正确');
        }
        //发送手机验证码
        SmsUtils.sendRegisterCode(username);
    }

//    public function actionIsLoggedIn($user_id, $api_login_token)
//    {
//        $result = ['is_logged_in' => false];
//        $user = User::findOne($user_id);
//        if($user && $user->api_login_token && $user->api_login_token == $api_login_token){
//            $result['is_logged_in'] = true;
//        }
//        return $result;
//    }
}
