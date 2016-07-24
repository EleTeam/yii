<?php
/**
 * @link http://www.eleteam.com/
 * @copyright Copyright (c) 2015 EleTeam
 * @license MIT License
 * @author 黄治华
 * @email 908601756@qq.com
 */

namespace common\components;

use common\models\User;
use Yii;
use yii\rest\Controller;

class ETRestController extends Controller
{
    /**
     * api返回的json
     * @param $status
     * @param $code
     * @param $message
     * @param $data
     * @param array $share
     * @return string
     * @apiVersion 1.0
     */
    private function jsonEncode($status, $data=[], $message='', $code=1, $share=[])
    {
        header('Content-type:application/json;charset=utf-8'); // 中文乱码问题
        $status     = boolval($status);
        $data       = $data ? $data : (object)array();
        $message    = strval($message);
        $code       = intval($code);
        $share      = $share ? $share : (object)array();

        $result = [
            'status'     => $status,
            'code' => $code,
            'message'    => $message,
            'data'       => $data,
            'share'      => $share,
        ];

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    protected function jsonSuccess($data=[], $message='', $code=1, $share=array())
    {
        $message = $message ? $message : '调用成功';
        return $this->jsonEncode(true, $data, $message, $code, $share);
    }

    protected function jsonFail($data=array(), $message='', $code=0, $share=array())
    {
        $message = $message ? $message : '调用失败';
        return $this->jsonEncode(false, $data, $message, $code, $share);
    }

    protected function isLoggedIn()
    {
        $user = User::findIdentityByAccessToken(@$_REQUEST['access_token']);
        return !!$user;
    }
}