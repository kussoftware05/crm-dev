<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\ShopPageAsset;

ShopPageAsset::register($this);

?>

<div class="container">

    <div class="row">
        <div class="col-sm-3">
            <div class="pull-left">
                <div class="form-group">
                    <form method="GET" id="sort-form">
                        <label for="exampleFormControlSelect1">Sort By</label>
                        <select class="form-control" id="sort-selector" name="orderby">
                            <option value="">Defualt</option>
                            <option value="price-asc">Price Low to High</option>
                            <option value="price-desc">Price High to Low</option>
                        </select>
                    </form>
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