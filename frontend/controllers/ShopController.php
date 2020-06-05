<?php

namespace frontend\controllers;

use Yii;
use \yii\web\Controller;
use admin\models\Product;

class ShopController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $order_by = $request->get('orderby');
        $product_data = [];
        switch ($order_by) {
            case 'price':
                $product_data = Product::productSortByPriceLowToHigh();
                break;

            case 'price-desc':
                $product_data = Product::productSortByPriceHighToLow();
                break;
            
            default:
                $product_data = Product::getAllProductData();
                break;
        }
        return $this->render('index',[
            'product_data' => $product_data
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
