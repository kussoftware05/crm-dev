<?php

namespace frontend\controllers;

use \yii\web\Controller;
use admin\models\Product;

class ShopController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index',[
            'product_data' => Product::getAllProductData()
        ]);
    }

}
