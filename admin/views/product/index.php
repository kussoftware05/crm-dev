<?php

use yii\helpers\Html;
use yii\grid\GridView;
use admin\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p class="pull-right">
        <?= Html::a('Export as json', ['export'], ['class' => 'btn btn-outline-danger btn-sm']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Product Image',
                'attribute' => 'image_id',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Product::getProductImageWithPath($data->image_id),
                        [
                            'width' => '70px',
                            'height' => '70px'
                        ]
                    );
                },
            ],
            'name',
            // 'short_desp:ntext',
            // 'long_desp:ntext',
            'productPriceWithCurrency',
            'productSellPriceWithCurrency',
            //'image_id',
            // 'quantity_in_stock',
            'catName',

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
