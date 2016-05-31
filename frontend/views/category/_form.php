<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'featured')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'featured_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_small')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'del_flag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'create_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'update_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_featured_home')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_featured_home_sort')->textInput() ?>

    <?= $form->field($model, 'parent_ids')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_audit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'href_target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_medium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_large')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
