<?php

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * Main admin application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/../web'; 
    public $css = [
        'css/site-login.css',
    ];
    public $js = [
    ];
}
