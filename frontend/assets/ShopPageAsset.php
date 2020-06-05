<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ShopPageAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/../web/shop';

    public $css = [
        
    ];
    
    public $js = [
        "js/shop.js",
    ];
}