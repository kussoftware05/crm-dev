<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                  'view' => function ($url, $model) {
                      return Html::a('<span class="fa fa-eye"></span>', $url);
                  },
      
                  'update' => function ($url, $model) {
                      return Html::a('<span class="fa fa-pen"></span>', $url);
                  },
                  'delete' => function ($url, $model) {
                    return Html::a('<span class="fa fa-trash"></span>',  $url, [
                          'title' => "Delete",
                          'aria-label' => "Delete",
                          'data-pjax' => "0",
                          'data-confirm' =>"Are you sure you want to delete this item?",
                          'data-method' => "post"
                        ]
                      );
                }
      
                ],
            ],
        ],
    ]); ?>


</div>
