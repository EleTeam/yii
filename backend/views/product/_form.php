<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-8\">{input} {error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>


    <div class="form-group field-product-image">
        <label for="product-image" class="col-lg-2 control-label"><?=Yii::t('app', 'Image')?></label>
        <div class="col-lg-8">
            <img id="show-product-image" src="<?=$model->image?>" class="" width="80" height="80" style="margin-right:10px;"/>

            <div class="help-block"></div>
        </div>
    </div>

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
