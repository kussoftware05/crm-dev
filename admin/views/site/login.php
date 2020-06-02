<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use admin\assets\LoginAsset;

LoginAsset::register($this);

$this->title = 'Admin Login';
?>
<div class = "main">
    <div class = "wrapper">
        <div class="container login-background">
            <div class="login">
                <div class="inner-log-in">
                    <div class="container">
                        <div style="padding: 27px 0px 27px 0px;">
                            <h3 class="text-center">CRM Admin</h3>
                        </div>
                    </div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <?= $form->field($model, 'username')->textInput() ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        <div class="container log-in-btn">
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Log In</button>
                            </div>  
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>  
    </div>
</div>