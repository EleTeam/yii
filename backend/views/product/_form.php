<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'featured_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_small')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'del_flag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'featured_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'featured_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'featured_position_sort')->textInput() ?>

    <?= $form->field($model, 'app_featured_home')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_featured_home_sort')->textInput() ?>

    <?= $form->field($model, 'app_featured_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_audit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'featured')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_medium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_large')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_featured_topic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_featured_topic_sort')->textInput() ?>

    <?= $form->field($model, 'app_long_image1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_long_image2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_long_image3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_long_image4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_long_image5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
