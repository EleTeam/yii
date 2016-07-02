<?php

namespace common\models;

use Yii;

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
 * @property integer $app_cart_cookie_id
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
            [['created_at', 'created_by', 'status', 'updated_at', 'updated_by', 'user_id', 'cookie_id', 'ip', 'app_cart_cookie_id'], 'integer'],
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
}
