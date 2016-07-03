<?php

namespace api\modules\v1\controllers;

use common\models\ProductAttrItem;
use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use common\models\Product;

class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';

    public function actions()
    {
        $actions = parent::actions();

        // 禁用"delete" 和 "create" 操作
        unset($actions['delete'], $actions['create'], $actions['update'], $actions['view']);

        // 使用"prepareDataProvider()"方法自定义数据provider
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProviderForIndex'];
        //$actions['view']['prepareDataProvider'] = [$this, 'prepareDataProviderForView'];

        return $actions;
    }

    public function actionView($id)
    {
        $expand = ['category', 'productAttrs'];
        $product = Product::find()->where('id=:id', [':id'=>$id])->with($expand)->one();

        //查找商品属性对象, @todo
        $productArr = $product->toArray([], $expand);
        if(isset($productArr['productAttrs'])){
            foreach($productArr['productAttrs'] as &$attr){
                $attrItem = ProductAttrItem::find()->where('id=:id', [':id'=>$attr['item_id']])->with(['productAttrItemValues'])->one();
                $attr['productAttrItem'] = $attrItem->toArray([], ['productAttrItemValues']);
            }
        }

        //购物车项数量

        $data = [
            'product' => $productArr,
            'cart_item_num' => 2,
            'product_collected' => '1',
        ];
        return $data;
    }

    public function prepareDataProviderForIndex()
    {
        $category_id = $_GET['category_id'];
        $query = Product::listAllByCategoryId($category_id,
            'id, name, category_id, price, featured_price, image_small, short_description');

        //die($query->createCommand()->getRawSql());

        $dataProvider = new ActiveDataProvider(['query' => $query]);
        return $dataProvider;
    }
}
