<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $featured
 * @property string $image
 * @property string $featured_image
 * @property string $image_small
 * @property string $name
 * @property string $parent_id
 * @property integer $sort
 * @property string $del_flag
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $short_description
 * @property string $app_featured_home
 * @property integer $app_featured_home_sort
 * @property string $parent_ids
 * @property string $remarks
 * @property string $is_audit
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $href
 * @property string $href_target
 * @property string $image_medium
 * @property string $image_large
 */
class Category extends \common\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['sort', 'app_featured_home_sort'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['id', 'parent_id', 'created_by', 'updated_by'], 'string', 'max' => 64],
            [['featured', 'del_flag', 'app_featured_home', 'is_audit'], 'string', 'max' => 1],
            [['image', 'featured_image', 'image_small', 'name', 'short_description', 'remarks', 'meta_keywords', 'meta_description', 'href'], 'string', 'max' => 255],
            [['parent_ids'], 'string', 'max' => 2000],
            [['href_target'], 'string', 'max' => 7],
            [['image_medium', 'image_large'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'featured' => Yii::t('app', 'Featured'),
            'image' => Yii::t('app', 'Image'),
            'featured_image' => Yii::t('app', 'Featured Image'),
            'image_small' => Yii::t('app', 'Image Small'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'sort' => Yii::t('app', 'Sort'),
            'del_flag' => Yii::t('app', 'Del Flag'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'short_description' => Yii::t('app', 'Short Description'),
            'app_featured_home' => Yii::t('app', 'App Featured Home'),
            'app_featured_home_sort' => Yii::t('app', 'App Featured Home Sort'),
            'parent_ids' => Yii::t('app', 'Parent Ids'),
            'remarks' => Yii::t('app', 'Remarks'),
            'is_audit' => Yii::t('app', 'Is Audit'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'href' => Yii::t('app', '超链接地址，优先级“高”'),
            'href_target' => Yii::t('app', '超链接打开的目标窗口，新窗口打开，请填写：“_blank”, 目标（_blank、_self、_parent、_top）'),
            'image_medium' => Yii::t('app', 'Image Medium'),
            'image_large' => Yii::t('app', 'Image Large'),
        ];
    }
}
