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
     * 购物车首页
     */
    public function actionIndex($app_cart_cookie_id='')
    {
        $cartItemsArr = [];
        $cart_num = 0;
        $total_price = 0;

        if($this->isLoggedIn()){
            $cart = Cart::findOneByUserId($this->getUserId());
        }else{
            $cart = Cart::findOneByAppCartCookieId($app_cart_cookie_id);
        }
        if($cart) {
            $itemsSummary = Cart::findItemsSummary($cart->id);
            foreach($itemsSummary['cartItems'] as $cartItem){
                $cartItemsArr[] = $cartItem->toArray([], ['product']);
            }
            $total_price = $itemsSummary['total_price'];
            $cart_num = $itemsSummary['cart_num'];
        }

        $data = [
            'cartItems' => $cartItemsArr,
            'cart_num' => $cart_num,
            'total_price' => $total_price,
            'is_logged_in' => $this->isLoggedIn(),
        ];
        return $this->jsonSuccess($data);
    }

    /**
     * 添加产品到购物车，如果app_cart_cookie_id为空则生成唯一的它
     * attributes 的格式是 itemId_itemValueId, 如 1_2,2_10,3_15
     */
    public function actionAdd()
    {
        $request = Yii::$app->request;
        $product_id = $_REQUEST['product_id'];
        $count = $request->get('count');
        $attributes = $_REQUEST['attributes'];
        $app_cart_cookie_id = $request->get('app_cart_cookie_id') ? $request->get('app_cart_cookie_id') : Cart::genAppCartCookieId();
        $attrs = $this->attributesToKeyValues($attributes);
        $cart_num = 0;

        try {
            if ($this->isLoggedIn()) {

            } else {
                $cart = Cart::addItemByAppCartCookieId($app_cart_cookie_id, $product_id, $count, $attrs);
                $cart_num = $cart->countCartNum($cart->id);
            }
        } catch (DbException $e) {
            return $this->jsonFail([], $e->getMessage());
        }

        $data = [
            'is_logged_in' => $this->isLoggedIn(),
            'app_cart_cookie_id' => $app_cart_cookie_id,
            'cart_num' => $cart_num,
        ];
        return $this->jsonSuccess($data);
    }

    /**
     * 格式化的属性和属性值转换为数组
     * @param $attributes 的格式是 itemId_itemValueId, 如 1_2,2_10,3_15
     * @return array 的格式 [$item_id=>$value_id, 1=>2, ...]
     */
    protected function attributesToKeyValues($attributes)
    {
        $attrs = [];
        $attrStrs = explode(',', $attributes);
        foreach($attrStrs as $attrStr){
            $parts = explode('_', $attrStr);
            $attrs[$parts[0]] = $parts[1];
        }
        return $attrs;
    }
}