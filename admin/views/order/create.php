<?php

use yii\helpers\Html;
use admin\assets\OrderAsset;

OrderAsset::register($this);

/* @var $this yii\web\View */
/* @var $model admin\models\OrderMaster */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-master-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'shipping_model' => $shipping_model,
        'billing_model' => $billing_model,
        'order_model' => $order_model,
        'customer_list' => $customer_list,
        'product_list'  => $product_list
    ]) ?>

</div>
