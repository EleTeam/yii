<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class CategoryController extends ActiveController
{
    public $modelClass = 'common\models\ProductCategory';
}
