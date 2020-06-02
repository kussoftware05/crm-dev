<?php 
use yii\widgets\Menu;
use yii\helpers\Html;
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    
    <?php 
        echo Menu::widget([
            'items' => [
                ['label' => 'Dashboard', 'url' => ['site/index']],
            ],
            'itemOptions'=>array('class'=>'nav-item d-none d-sm-inline-block'),
            'options' => array( 'class' => 'navbar-nav', 'id'=>'navbar-id' ),
            'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
        ]);
                
    ?>

    <?php
        if(!Yii::$app->user->isGuest) {
        echo  Html::beginForm(['/site/logout'], 'post') 
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm();
        }
    ?>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
            </button>
        </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
        </li>
    </ul>
</nav>
