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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * details view of an product
     * 
     * @param int $id
     */
    public function actionProduct($id)
    {
        if(filter_var($id,FILTER_VALIDATE_INT) === false)
            return $this->render('error');
        
        return $this->render('product-detail',[
            'product' => Product::getProductById($id),
            'more_products' => Product::getRelatedProductByCategory($id,
                                Product::getProductCategoryId($id)
                                )
        ]);

    }

}
