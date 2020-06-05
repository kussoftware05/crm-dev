<?php

namespace admin\controllers;

use Yii;
use admin\models\Product;
use admin\models\ProductSearch;
use admin\models\ProductCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'product_img' => Product::getProductImageWithPath($id)
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        if(Yii::$app->request->isPost)
        {
            if($model->createProduct(Yii::$app->request->post(), $_FILES['image'])) {
                return $this->redirect('index');
            } else {
                echo 'error';
            }
        }
        return $this->render('create', [
            'model' => $model,
            'product_cat' => ProductCategory::getAllCategoryForDropdown()
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if(Yii::$app->request->isPost) {
            $product = new Product;
            if($product->updateProduct($id,Yii::$app->request->post(),$_FILES['image'])) {
                return $this->redirect('index');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'product_cat' => ProductCategory::getAllCategoryForDropdown(),
            'product_img' => Product::getProductImageWithPath($id)
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Product::deleteProduct($id);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTest()
    {
        echo '<pre>';
        print_r(ProductCategory::getCategoryNameById(1));
        echo '</pre>';
    }

    /**
     * export data as csv format
     */
    public function actionExport()
    {
        $product_data = Product::getAllProductData();
        $exporter = new \admin\helpers\Export(new \admin\helpers\ExportAsJson);
        header('Content-disposition: attachment; filename=products.json');
        header('Content-type: application/json');
        echo $exporter->export($product_data);
        die();
    }
}
