<?php

namespace admin\controllers;

use Yii;
use admin\models\ShippingMaster; 
use admin\models\BillingMaster;
use admin\models\OrderMaster;
use admin\models\Product;
use common\models\User;
use admin\models\OrderMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for OrderMaster model.
 */
class OrderController extends Controller
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
     * Lists all OrderMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderMaster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OrderMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $shipping_model = new ShippingMaster;
        $billing_model = new BillingMaster;
        $order_model = new OrderMaster;

        if(Yii::$app->request->isPost)
        {
            $product_list = Yii::$app->request->post('productlist');
            if($order_model->createNewOrder(Yii::$app->request->post(),$product_list))
                return $this->redirect('index');
            else
                return $this->redirect('index');
        }
        
        return $this->render('create', [
            'shipping_model' => $shipping_model,
            'billing_model' => $billing_model,
            'order_model'   => $order_model,
            'customer_list' => User::getAllUserWithNames(),
            'product_list' => Product::getAllProductNameWithPrice()
        ]);
    }

    /**
     * Updates an existing OrderMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $shipping_model = ShippingMaster::findOne($model->shipping_id);
        $billing_model = BillingMaster::findOne($model->billing_id);
        $order_model = $model;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'shipping_model' => $shipping_model,
            'billing_model' => $billing_model,
            'order_model'   => $order_model,
            'customer_list' => User::getAllUserWithNames(),
            'product_list' => Product::getAllProductNameWithPrice()
        ]);
    }

    /**
     * Deletes an existing OrderMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
