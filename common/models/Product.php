<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $id
 * @property string $image
 * @property string $featured_image
 * @property string $image_small
 * @property string $name
 * @property integer $sort
 * @property string $del_flag
 * @property string $created_at
 * @property string $create_by
 * @property string $updated_at
 * @property string $update_by
 * @property string $price
 * @property string $featured_price
 * @property string $featured_position
 * @property integer $featured_position_sort
 * @property string $app_featured_home
 * @property integer $app_featured_home_sort
 * @property string $app_featured_image
 * @property string $short_description
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $is_audit
 * @property string $remarks
 * @property string $featured
 * @property string $description
 * @property string $category_id
 * @property string $image_medium
 * @property string $image_large
 * @property string $app_featured_topic
 * @property integer $app_featured_topic_sort
 * @property string $app_long_image1
 * @property string $app_long_image2
 * @property string $app_long_image3
 * @property string $type
 * @property string $app_long_image4
 * @property string $app_long_image5
 * @property string $status
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['sort', 'featured_position_sort', 'app_featured_home_sort', 'app_featured_topic_sort'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['price', 'featured_price'], 'number'],
            [['description'], 'string'],
            [['id', 'create_by', 'update_by', 'category_id'], 'string', 'max' => 64],
            [['image', 'featured_image', 'image_small', 'name', 'featured_position', 'app_featured_image', 'short_description', 'meta_keywords', 'meta_description', 'remarks', 'app_long_image4', 'app_long_image5'], 'string', 'max' => 255],
            [['del_flag', 'app_featured_home', 'is_audit', 'featured', 'app_featured_topic', 'type', 'status'], 'string', 'max' => 1],
            [['image_medium', 'image_large', 'app_long_image1', 'app_long_image2', 'app_long_image3'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'featured_image' => 'Featured Image',
            'image_small' => '小图',
            'name' => 'Name',
            'sort' => 'Sort',
            'del_flag' => 'Del Flag',
            'created_at' => 'Create Date',
            'create_by' => 'Create By',
            'updated_at' => 'Update Date',
            'update_by' => 'Update By',
            'price' => 'Price',
            'featured_price' => 'Featured Price',
            'featured_position' => 'Featured Position',
            'featured_position_sort' => 'Featured Position Sort',
            'app_featured_home' => 'App Featured Home',
            'app_featured_home_sort' => 'App Featured Home Sort',
            'app_featured_image' => 'App Featured Image',
            'short_description' => 'Short Description',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'is_audit' => 'Is Audit',
            'remarks' => 'Remarks',
            'featured' => 'Featured',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'image_medium' => 'Image Medium',
            'image_large' => 'Image Large',
            'app_featured_topic' => 'App Featured Topic',
            'app_featured_topic_sort' => 'App Featured Topic Sort',
            'app_long_image1' => 'App Long Image1',
            'app_long_image2' => 'App Long Image2',
            'app_long_image3' => 'App Long Image3',
            'type' => 'Type',
            'app_long_image4' => 'App Long Image4',
            'app_long_image5' => 'App Long Image5',
            'status' => '状态',
        ];
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
