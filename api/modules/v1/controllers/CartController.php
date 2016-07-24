<?php

namespace api\modules\v1\controllers;

use common\models\Cart;
use Yii;
use common\components\ETRestController;
use yii\db\Exception as DbException;

class CartController extends ETRestController
{
//    /**
//     * 行为: 登录认证
//     *    actionAdd() 登录或非登录用户都可以访问,所有不能用这种验证方法
//     * @return array
//     */
//    public function behaviors()
//    {
//        return ArrayHelper::merge(parent::behaviors(), [
//            'authenticator' => [
//                #这个地方使用`ComopositeAuth` 混合认证
//                'class' => CompositeAuth::className(),
//                #`authMethods` 中的每一个元素都应该是 一种 认证方式的类或者一个 配置数组
//                'authMethods' => [
//                    //HttpBasicAuth::className(),
//                    //HttpBearerAuth::className(),
//                    QueryParamAuth::className(), //url as: http://api.eleteam.com/v1/users?access-token=123
//                ]
//            ]
//        ]);
//    }

    /**
     * 添加产品到购物车，如果app_cart_cookie_id为空则生成唯一的它
     * attributes 的格式 itemId_itemValueId, 如["3_15","2_10",...]
     */
    public function actionAdd($product_id=0, $count=1, $attributes='', $app_cart_cookie_id='')
    {
        $app_cart_cookie_id = $app_cart_cookie_id ? $app_cart_cookie_id : Cart::genAppCartCookieId();
        $attrs = $this->attributesToKeyValues($attributes);

        try {
            if ($this->isLoggedIn()) {

            } else {
                $cart = Cart::addItemByAppCartCookieId($app_cart_cookie_id, $product_id, $count, $attrs);
            }
        } catch (DbException $e) {
            return $this->jsonFail([], $e->getMessage());
        }

        $data = [
            'is_logged_in' => $this->isLoggedIn(),
            'app_cart_cookie_id' => $cart->app_cart_cookie_id,
        ];
        return $this->jsonSuccess($data);
    }

    public function actionView()
    {
        echo '1';
    }

    /**
     * 格式化的属性和属性值转换为数组
     * @param $attributes
     * @return array 的格式 [$item_id=>$value_id, 1=>2, ...]
     */
    protected function attributesToKeyValues($attributes)
    {
        $attrs = [];
        return $attrs;
    }
}