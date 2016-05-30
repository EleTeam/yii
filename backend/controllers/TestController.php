<?php

namespace backend\controllers;

class TestController extends \yii\web\Controller
{
    public $layout='main.bak.php';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
