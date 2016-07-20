<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Demo */

$this->title = Yii::t('app', 'Create Demo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
