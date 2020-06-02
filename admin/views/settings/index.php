<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
?>


<div class="container">
<h3>Admin Settings</h3>
    <p>Hi! <?php echo Yii::$app->user->identity->username ?></p>
    <div>
        <a href="<?= Url::toRoute('settings/change-password'); ?>">change password</a>
    </div>
   <div>
       <a href="<?= Url::toRoute('settings/change-email'); ?>">change email</a>
   </div>
</div>