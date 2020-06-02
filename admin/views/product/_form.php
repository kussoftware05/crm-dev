<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9">

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'long_desp')->widget(CKEditor::className(), [
                    'options' => ['rows' => 10],
                    'preset' => 'basic'
                ]) ?>
               
                <?= $form->field($model, 'short_desp')->widget(CKEditor::className(), [
                    'options' => ['rows' => 5],
                    'preset' => 'basic'
                ]) ?>
            </div>
            <div class="col-sm-3 col-md-3">

                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'sell_price')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'quantity_in_stock')->textInput() ?>

                <?= $form->field($model, 'product_cat_id')->dropDownList($product_cat,['prompt' => 'Select A Category']) ?>

                <div class="form-group field-product-image_id">
                    <label class="control-label" for="product-image_id">Product Image</label>
                    <input type="file" id="product-image_id" name="image">
                </div>

                <?php if(!$model->isNewRecord) : ?>
                    <label>Current Image:</label>
                    <image src="<?= $product_img ?>" width="150" height="100">
                <?php endif ?>
                
            </div>
        </div>

        <div class="form-group mt-3">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
