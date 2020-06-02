<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\OrderMaster */

$this->title = 'Update Order Master: ' . $order_model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $order_model->id, 'url' => ['view', 'id' => $order_model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'shipping_model' => $shipping_model,
        'billing_model' => $billing_model,
        'order_model' => $order_model,
        'customer_list' => $customer_list,
        'product_list'  => $product_list
    ]) ?>

</div>
