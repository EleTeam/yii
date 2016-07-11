<?php

namespace api\modules\v1\controllers;

use common\components\ETRestController;
use common\models\LoginForm;
use common\models\User;
use Yii;

class AuthController extends ETRestController
{
    /**
     * 通过手机号码快捷登录
     * @param $mobile
     * @param $code
     */
    public function actionMobilelogin($mobile, $code)
    {
        if(strlen($mobile)<11){
            return $this->jsonFail([], '手机号格式不正确');
        }

        //验证码验证, 未实现 @todo
        if($code != '8888'){
            return $this->jsonFail([], '验证码不正确');
        }

        //手机号存在
        $user = User::findOneByMobile($mobile);

        //如果手机号不存在则创建用户
        if(!$user){
            $user = new User();
            $data = ['User' => ['mobile' => $mobile]];
            if($user->load($data) && $user->save(false)){
                //
            }else{
                return $this->jsonFail($user->errors, '创建用户失败');
            }
        }

        //如果没有access_token,则创建
        $user->access_token = $user->getAccessToken();
        return $this->jsonSuccess(['user'=>$user->toArray()], '登录成功');
    }

    /**
     * api登录, 返回access-token值
     * post: [mobile:123, password=abc]
     * @return LoginForm|string
     */
    public function actionLogin()
    {
        $mobile = Yii::$app->request->post('mobile');
        $password = Yii::$app->request->post('password');

        $user = User::findOneByMobile($mobile);
        if($user && $user->validatePassword($password)){
            $user->getAccessToken();
            return $this->jsonSuccess(['user'=>$user->toArray()]);
        }

        return $this->jsonFail(Yii::$app->request->post(), '手机号或密码错误');

//        $data = [
//            'username' => $mobile,
//            'password' => $password,
//        ];
//        $model = new LoginForm();
//        if ($model->load($data, '') && $model->login()) {
//            return Yii::$app->user->identity->access_token;
//            return Yii::$app->user->identity->getAuthKey();
//        } else {
//            return $model;
//        }
    }

    public function actionSendcode($mobile)
    {
        if(strlen($mobile)<11){
            return $this->jsonFail([], '手机号格式不正确');
        }

        $user = User::findOneByMobile($mobile);
        if($user && $user->id){
            return $this->jsonFail([], '手机号已存在');
        }

        //发送手机验证码, 未实现, @todo

        return $this->jsonSuccess([], '验证码已发送');
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