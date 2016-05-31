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
 * @property string $create_date
 * @property string $create_by
 * @property string $update_date
 * @property string $update_by
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
class Category extends \yii\db\ActiveRecord
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
            [['create_date', 'update_date'], 'safe'],
            [['id', 'parent_id', 'create_by', 'update_by'], 'string', 'max' => 64],
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
            'id' => 'ID',
            'featured' => 'Featured',
            'image' => 'Image',
            'featured_image' => 'Featured Image',
            'image_small' => 'Image Small',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
            'del_flag' => 'Del Flag',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
            'short_description' => 'Short Description',
            'app_featured_home' => 'App Featured Home',
            'app_featured_home_sort' => 'App Featured Home Sort',
            'parent_ids' => 'Parent Ids',
            'remarks' => 'Remarks',
            'is_audit' => 'Is Audit',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'href' => '超链接地址，优先级“高”',
            'href_target' => '超链接打开的目标窗口，新窗口打开，请填写：“_blank”, 目标（_blank、_self、_parent、_top）',
            'image_medium' => 'Image Medium',
            'image_large' => 'Image Large',
        ];
    }
}
