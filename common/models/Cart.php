<?php

namespace common\models;

use Yii;
use yii\db\Exception as DbException;
use common\components\ETActiveRecord;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $status
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $user_id
 * @property integer $cookie_id
 * @property integer $ip
 * @property string $app_cart_cookie_id
 *
 * @property CartItem[] $cartItems
 */
class Cart extends ETActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'status', 'updated_at', 'updated_by', 'user_id', 'cookie_id', 'ip'], 'integer'],
            [['app_cart_cookie_id'], 'string'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'user_id' => Yii::t('app', 'User ID'),
            'cookie_id' => Yii::t('app', 'Cookie ID'),
            'ip' => Yii::t('app', 'Ip'),
            'app_cart_cookie_id' => Yii::t('app', 'App Cart Cookie ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartItems()
    {
        return $this->hasMany(CartItem::className(), ['cart_id' => 'id']);
    }

    /**
     * 构建唯一的 app_cart_cookie_id
     * @return string
     */
    public static function genAppCartCookieId()
    {
        return md5(uniqid('app_cart_cookie_id', true) . microtime());
    }

    /**
     * @param $attributes
     */
    public static function attributesJsonDecode($attributes)
    {
        $attrs = [
            ['item_id' => '1', 'item_value' => 2],
            ['item_id' => '3', 'item_value' => 4],
        ];
        return $attrs;
    }

    /**
     * 查找购物车, 通过$app_cart_cookie_id
     * @param $app_cart_cookie_id
     * @return null|static
     */
    public static function findOneByAppCartCookieId($app_cart_cookie_id)
    {
        if(!$app_cart_cookie_id)
            return null;
        return static::findOne(['app_cart_cookie_id'=>$app_cart_cookie_id]);
    }

    /**
     * 添加产品到购物车
     * @param $app_cart_cookie_id
     * @param $product_id
     * @param $count
     * @param $attrs 的格式 [$item_id=>$value_id, 1=>2, ...]
     * @return Cart|null
     * @throws DbException
     */
    public static function addItemByAppCartCookieId($app_cart_cookie_id, $product_id, $count, $attrs)
    {
        $product = Product::findOne($product_id);
        if(!$product){
            throw new DbException('商品不存在');
        }

        $cart = Cart::findOneByAppCartCookieId($app_cart_cookie_id);
        if($cart){ //购物车存在
            $cartItem = CartItem::findOneByCartIdProductIdAttrs($cart->id, $product_id, $attrs);
            if($cartItem){ //对应属性的产品在购物车里
                $cartItem->count = $cartItem->count + $count;
                $cartItem->is_selected = CartItem::YES;
                $cartItem->save();
            }else{ //对应属性的产品不在购物车里
                //添加购物车项
                $cartItemNew = new CartItem();
                $itemData = [
                    'app_cart_cookie_id' => $cart->app_cart_cookie_id,
                    'cart_id' => $cart->id,
                    'product_id' => $product_id,
                    'count' => $count,
                ];
                if($cartItemNew->load($itemData, '') && $cartItemNew->save()){
                }else{
                    throw new DbException($cartItemNew->errorsToString());
                }
                //添加购物车项的属性
                foreach($attrs as $attr_item_id => $attr_item_value_id) {
                    $itemAttr = new CartItemAttr();
                    $itemAttrData = [
                        'item_id' => $cartItemNew->id,
                        'attr_item_id' => $attr_item_id,
                        'attr_item_value_id' => $attr_item_value_id,
                    ];
                    if ($itemAttr->load($itemAttrData, '') && $itemAttr->save()) {
                    } else {
                        throw new DbException($itemAttr->errorsToString());
                    }
                }
            }
        }else{ //购物车不存在
            //添加购物车
            $cart = new Cart();
            $cartData = [
                'app_cart_cookie_id' => self::genAppCartCookieId()
            ];
            if($cart->load($cartData, '') && $cart->save()){
                //添加购物车项
                $item = new CartItem();
                $itemData = [
                    'app_cart_cookie_id' => $cart->app_cart_cookie_id,
                    'cart_id' => $cart->id,
                    'product_id' => $product_id,
                    'count' => $count,
                ];
                if($item->load($itemData, '') && $item->save()){
                }else{
                    throw new DbException($item->errorsToString());
                }
            }else{
                throw new DbException($cart->errorsToString());
            }

        }

        return $cart;
	}

    /**
     * 购物车的个数
     */
    public function countCartNum($cart_id, $is_selected=1, $is_ordered=0)
    {
        $cart_num = 0;
        $items = CartItem::find()->where(['cart_id'=>$cart_id, 'is_selected'=>$is_selected, 'is_ordered'=>$is_ordered])->all();
        foreach($items as $item){
            $cart_num += $item->count;
        }
        return $cart_num;
    }
}
