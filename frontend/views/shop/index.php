<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="container">

    <div class="row">
        <div class="col-sm-3">
            <div class="pull-left">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Sort By</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Price Low to High</option>
                        <option>Price High to Low</option>
                    </select>
                  </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="row mt-3">
            <?php foreach($product_data as $product) : ?>
                <div class="col-sm-3" style="margin-top:50px; float:left;">
                    <img src="<?php echo $product['image'] ?>" alt="<?= $product['name'] ?>" width="100" height="100">
                    <a href=<?php echo Url::to(['shop/product', 'id' => $product['id']]) ?>>
                        <p><?= $product['name'] ?></p>
                    </a>
                    <p style="color: #B12704"><?= $product['price'] ?></p>
                </div>
            <?php endforeach ?>
            </div>
        </div>
    </div>
</div>