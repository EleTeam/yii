<?php

namespace api\modules\v1\controllers;

use common\models\ProductCategory;
use Yii;
use common\components\ETRestController;
use common\models\ProductAttrItem;
use yii\data\ActiveDataProvider;
use common\models\Product;

class CategoryController extends ETRestController
{
    public function actionListWithProduct()
    {
//        $query = ProductCategory::findAll()->where()->with(['products']);
        $query = ProductCategory::find()
            ->where('status=:status and id!=:id', [':status'=>ProductCategory::STATUS_ACTIVE, ':id'=>ProductCategory::ROOT_LEVEL_ID])
            ->with(['products'])
            ->all();
        $categories = [];
        foreach($query as $category){
            $categories[] = $category->toArray([], ['products']);
        }

        return $this->jsonSuccess($categories);
    }
}
