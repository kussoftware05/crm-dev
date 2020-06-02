<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model admin\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="container">
        <div class="row">

            <div class="col-sm-9 col-md-9">

                <?= $form->field($model, 'btn_text')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'content')->widget(CKEditor::className(), [
                    'options' => ['rows' => 10],
                    'preset' => 'basic'
                ]) ?>

            </div>
            <div class="col-sm-3 col-md-3">

                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Active', 'N' => 'Not-Active', ], ['prompt' => 'Select Status']) ?>

                <div class="form-group">
                    <label class="control-label" for="slider-image">Browse For Image</label>
                    <input type="file" name="image" id="image">
                </div>


                <?php if(!$model->isNewRecord) : ?>
                    <label>Current Image:</label>
                    <image src="<?= $image_src ?>" width="150" height="100">
                <?php endif ?>

            </div>
        </div>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
