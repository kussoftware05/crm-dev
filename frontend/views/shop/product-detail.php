<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

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
    .p-price-with-sale{
        font-size: 14px;
        text-decoration: line-through;
        color: green;
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
            <?php if(array_key_exists('save_price',$product)) : ?>
                <p class="product-price"><?= $product['sell_price'] ?> <span class="p-price-with-sale"><?= $product['price'] ?></span></p>
                <p>Save : <span style="color: red;"><?= $product['save_price']?>&percnt;</span></p>
            <?php else : ?>
                <p class="product-price"><?= $product['price'] ?></p>
            <?php endif ?>

            <div>
                <p><?= $product['long_desp'] ?></p>
            </div>

            <div>
                <input type="number" name="quantity" value="1" min="1" max="50" style="width:9%">
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

<?php if($more_products) : ?>
<div class="container">
    <h3>Related products</h3>
    <div class="row mt-3">
    <?php foreach($more_products as $product) : ?>
        <div class="col-sm-3" style="margin-top:50px;">
            <img src="<?php echo $product['image'] ?>" alt="<?= $product['name'] ?>" width="100" height="100">
            <a href=<?php echo Url::to(['shop/product', 'id' => $product['id']]) ?>>
                <p><?= $product['name'] ?></p>
            </a>
            <p style="color: #B12704"><?= $product['price'] ?></p>
        </div>
    <?php endforeach ?>
    </div>
</div>
<?php endif ?>