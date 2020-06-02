<?php

namespace admin\models;

use Yii;
use common\models\User;
use admin\models\BillingMaster;
use admin\models\ShippingMaster;
use admin\models\OrderDetails;
use admin\models\Product;
/**
 * This is the model class for table "order_master".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $billing_id
 * @property int|null $shipping_id
 * @property string|null $order_date
 * @property float $order_amount
 * @property float $order_discount
 * @property float $shipping_cost
 * @property float $tax
 * @property string|null $order_status
 *
 * @property OrderDetails[] $orderDetails
 * @property BillingMaster $billing
 * @property ShippingMaster $shipping
 * @property User $user
 */
class OrderMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'billing_id', 'shipping_id'], 'integer'],
            [['order_date'], 'safe'],
            [['order_amount', 'order_discount', 'shipping_cost', 'tax'], 'number'],
            [['order_status'], 'string'],
            [['billing_id'], 'exist', 'skipOnError' => true, 'targetClass' => BillingMaster::className(), 'targetAttribute' => ['billing_id' => 'id']],
            [['shipping_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingMaster::className(), 'targetAttribute' => ['shipping_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'billing_id' => 'Billing ID',
            'shipping_id' => 'Shipping ID',
            'order_date' => 'Order Date',
            'order_amount' => 'Order Amount',
            'order_discount' => 'Order Discount',
            'shipping_cost' => 'Shipping Cost',
            'tax' => 'Tax',
            'order_status' => 'Order Status',
        ];
    }

    /**
     * Gets query for [[OrderDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetails::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Billing]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBilling()
    {
        return $this->hasOne(BillingMaster::className(), ['id' => 'billing_id']);
    }

    /**
     * Gets query for [[Shipping]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShipping()
    {
        return $this->hasOne(ShippingMaster::className(), ['id' => 'shipping_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * create a new order
     * 
     * @param array $post_data
     */
    public function createNewOrder($post_data, $product_list)
    {
        $billing_model = new BillingMaster;
        $shipping_model = new ShippingMaster;

        if($billing_model->load($post_data))
            $billing_model->insert();
        
        if($shipping_model->load($post_data))
            $shipping_model->insert();
    
        if($this->load($post_data))
        {
            $this->billing_id = $billing_model->id;
            $this->shipping_id = $shipping_model->id;
            $this->order_discount = 0.00;
            $this->shipping_cost = 0.00;
            $this->tax = 0.00;
            $this->insert();
            $billing_model->user_id = $this->user_id;
            $shipping_model->user_id = $this->user_id;
            $billing_model->update(false);
            $shipping_model->update(false);
        }
        $total_order_amout = 0;
        foreach($post_data['productlist'] as $product_id)
        {
            $order_details = new OrderDetails;
            $price = Product::getPriceById($product_id);
            $order_details->order_id = $this->id;
            $order_details->product_id = $product_id;
            $order_details->user_id = $this->user_id;
            $order_details->price = $price;
            $order_details->quantity = 1;
            $order_details->save();
            $total_order_amout += $price;
        }
        $this->order_amount = $total_order_amout;
        $this->update(false);
        return true;
    }
}
