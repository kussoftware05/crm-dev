<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model admin\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9">

                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'content')->widget(CKEditor::className(), [
                    'options' => ['rows' => 10],
                    'preset' => 'basic'
                ]) ?>
                
                <?= $form->field($model, 'short_desp')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="col-sm-3 col-md-3">
            
                <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->dropDownList([ 'draft' => 'Draft', 'published' => 'Published', ], ['prompt' => 'Choose...']) ?>

                <?= $form->field($model, 'cat_id')->dropDownList($cats,['prompt' => 'Select Category']) ?>

                <div class="form-group">
                    <label class="control-label" for="blog-status">Image</label>
                    <input type="file" name="blog_image">
                </div>

                <?php if(!$model->isNewRecord) : ?>
                    <label>Current Image:</label>
                    <image src="<?= $img_src ?>" width="150" height="100">
                <?php endif ?>

            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
    /*
    <?= $form->field($model, 'published_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>
    */
?>