<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\models\OrderMaster;

/**
 * OrderMasterSearch represents the model behind the search form of `admin\models\OrderMaster`.
 */
class OrderMasterSearch extends OrderMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'billing_id', 'shipping_id'], 'integer'],
            [['order_date', 'order_status'], 'safe'],
            [['order_amount', 'order_discount', 'shipping_cost', 'tax'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = OrderMaster::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'billing_id' => $this->billing_id,
            'shipping_id' => $this->shipping_id,
            'order_date' => $this->order_date,
            'order_amount' => $this->order_amount,
            'order_discount' => $this->order_discount,
            'shipping_cost' => $this->shipping_cost,
            'tax' => $this->tax,
        ]);

        $query->andFilterWhere(['like', 'order_status', $this->order_status]);

        return $dataProvider;
    }
}
