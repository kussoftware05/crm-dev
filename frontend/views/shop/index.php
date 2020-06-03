<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
?>

<div class="container">

    <div class="row mt-3">
    <?php foreach($product_data as $product) : ?>
        <div class="col-sm-3" style="margin-top:50px;">
            <img src="<?php echo $product['image'] ?>" alt="Girl in a jacket" width="100" height="100">
            <p><?= $product['name'] ?></p>
            <p style="color: #B12704"><?= $product['price'] ?></p>
        </div>
    <?php endforeach ?>
    </div>
</div>