<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cart_item_attr".
 *
 * @property integer $id
 * @property integer $item_id 来自CartItem::$id
 * @property integer $attr_item_id 来自ProductAttrItem::$id
 * @property integer $attr_item_value_id 来自ProductAttrItemValue::$id
 * @property string $attr_idstring 格式 {$attr_item_id}_{$attr_item_value_id}, 如 12_23
 * @property integer $status
 *
 * @property ProductAttrItem $attrItem
 * @property ProductAttrItemValue $attrItemValue
 * @property CartItem $item
 */
class CartItemAttr extends ETActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_item_attr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'attr_item_id', 'attr_item_value_id', 'status'], 'integer'],
            [['attr_idstring'], 'string', 'max' => 255],
            [['attr_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductAttrItem::className(), 'targetAttribute' => ['attr_item_id' => 'id']],
            [['attr_item_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductAttrItemValue::className(), 'targetAttribute' => ['attr_item_value_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => CartItem::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'item_id' => Yii::t('app', 'Item ID'),
            'attr_item_id' => Yii::t('app', 'Attr Item ID'),
            'attr_item_value_id' => Yii::t('app', 'Attr Item Value ID'),
            'attr_idstring' => Yii::t('app', 'Attr Idstring'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrItem()
    {
        return $this->hasOne(ProductAttrItem::className(), ['id' => 'attr_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrItemValue()
    {
        return $this->hasOne(ProductAttrItemValue::className(), ['id' => 'attr_item_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(CartItem::className(), ['id' => 'item_id']);
    }
}
