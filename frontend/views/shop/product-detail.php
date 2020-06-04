<?php
    use yii\helpers\Html;

?>
<style>
    .product-con {
        margin-left: 94px;
        margin-right: 94px;
    }

    .product-price {
        font-size: 21px;
        color: #840f0f;
    }
</style>

<?php if($product) : ?>
<div class="container">
    <div class="row product-con">
        <div class="col-sm-6 col-md-6">
            <img src="<?php echo $product['image'] ?>" alt="<?= $product['name'] ?>">
        </div>
        <div class="col-sm-6 col-md-6">
            <h4><?= $product['name'] ?></h4>
            <p class="product-price"><?= $product['price'] ?></p>

            <div>
                <p><?= $product['long_desp'] ?></p>
            </div>

            <div>
                <input type="number" name="quantity" value="1" style="width:9%">
                <button type="submit" class="btn btn-danger">Add to cart</button>
                <span>Category : <?= $product['category'] ?></span>
            </div>
        </div>
    </div>

    <div>
        <h5>Description</h5>
        <p><?= $product['short_desp'] ?></p>
    </div>
</div>
<?php endif ?>