<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model admin\models\Business */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .l-b {
        padding: 14px;
        background-color: #fff;
        margin: 12px;
    }
</style>
<div class="business-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-md-7">
                <div class="l-b">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'about')->widget(CKEditor::className(), [
                        'options' => ['rows' => 10],
                        'preset' => 'basic'
                    ]) ?>

                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'address_line_1')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'address_line_2')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>
                </div>
                
            </div>
            <div class="col-sm-5 col-md-5">
                <div class="r-b">
                    <label class="control-label" for="business-image">Business Image</label>
                    <div class="form-group">
                        <img src="https://dummyimage.com/150">
                    </div>
                    <label class="control-label" for="business-image">Business Day</label>
                    <?= $form->field($business_hours_model, 'day')->dropDownList($business_days,['prompt' => 'Select Day']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
