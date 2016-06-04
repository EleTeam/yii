<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use backend\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * 移植控制器
 */
class MigrationController extends BaseController
{
    /**
     * 移植产品图片
     */
    public function actionProductimage()
    {
        $products = Product::find()->all();
        foreach($products as $product){
//            if($product->image == '/public')
//                $product->image = null;
//            if($product->image_small == '/public')
//                $product->image_small = null;
//            if($product->image_large == '/public')
//                $product->image_large = null;
//            if($product->image_medium == '/public')
//                $product->image_medium = null;
//            if($product->app_long_image1 == '/public')
//                $product->app_long_image1 = null;
//            if($product->app_long_image2 == '/public')
//                $product->app_long_image2 = null;
//            if($product->app_long_image3 == '/public')
//                $product->app_long_image3 = null;
//            if($product->app_long_image4 == '/public')
//                $product->app_long_image4 = null;
//            if($product->app_long_image5 == '/public')
//                $product->app_long_image5 = null;
            $product->image = str_replace('/public', '/uploads/public/product', $product->image);
            $product->image_small = str_replace('/public', '/uploads/public/product', $product->image_small);
            $product->image_large = str_replace('/public', '/uploads/public/product', $product->image_large);
            $product->image_medium = str_replace('/public', '/uploads/public/product', $product->image_medium);
            $product->app_long_image1 = str_replace('/public', '/uploads/public/product', $product->app_long_image1);
            $product->app_long_image2 = str_replace('/public', '/uploads/public/product', $product->app_long_image2);
            $product->app_long_image3 = str_replace('/public', '/uploads/public/product', $product->app_long_image3);
            $product->app_long_image4 = str_replace('/public', '/uploads/public/product', $product->app_long_image4);
            $product->app_long_image5 = str_replace('/public', '/uploads/public/product', $product->app_long_image5);
            $product->save();
        }
        echo '移植产品图片结束';
        exit;
    }

    public function ActionProductId()
    {
        //category, product, product_attr
    }
}
