<?php

namespace api\modules\v1\controllers;

use common\models\Cart;
use common\models\CartItem;
use common\components\ETRestController;

class CartItemController extends ETRestController
{
    /**
     * 删除购物车项
     */
    public function actionDelete()
    {
        $id = $this->getParam('id');

        $item = CartItem::findOne($id);
        $item->status = CartItem::STATUS_DELETED;
        $item->save();
        $cart = Cart::myCart($this->getUserId(), $this->getAppCartCookieId());

        $data = [
            'app_cart_cookie_id' => $cart->app_cart_cookie_id,
            'cart_num' => Cart::sumCartNum($cart->id),
        ];
        return $this->jsonSuccess($data);
    }
}