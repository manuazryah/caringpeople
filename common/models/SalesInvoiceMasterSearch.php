<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SalesInvoiceMaster;

/**
 * SalesInvoiceMasterSearch represents the model behind the search form about `common\models\SalesInvoiceMaster`.
 */
class SalesInvoiceMasterSearch extends SalesInvoiceMaster {

    /**
     * @var string
     */
    public $createdFrom;

    /**
     * @var string
     */
    public $createdTo;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'order_type', 'payment_status', 'status', 'CB', 'UB', 'busines_partner_code', 'salesman'], 'integer'],
            [['sales_invoice_number', 'sales_invoice_date', 'payment_terms', 'delivery_terms', 'ship_to_adress', 'reference', 'error_message', 'DOC', 'DOU', 'due_date', 'general_terms', 'goods_total', 'service_total'], 'safe'],
            [['amount', 'tax_amount', 'order_amount', 'amount_payed', 'due_amount', 'discount_amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        if (!isset($params["SalesInvoiceMasterSearch"]["createdFrom"])) {
            $params["SalesInvoiceMasterSearch"]["createdFrom"] = '';
        } else {
            $params["SalesInvoiceMasterSearch"]["createdFrom"] = $params["SalesInvoiceMasterSearch"]["createdFrom"] . ' 00:00:00';
        }
        if (!isset($params["SalesInvoiceMasterSearch"]["createdTo"])) {
            $params["SalesInvoiceMasterSearch"]["createdTo"] = '';
        } else {
            $params["SalesInvoiceMasterSearch"]["createdTo"] = $params["SalesInvoiceMasterSearch"]["createdTo"] . ' 60:60:60';
        }
        $query = SalesInvoiceMaster::find()->orderBy(['id' => SORT_DESC]);

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
            'sales_invoice_date' => $this->sales_invoice_date,
            'order_type' => $this->order_type,
            'amount' => $this->amount,
            'tax_amount' => $this->tax_amount,
            'order_amount' => $this->order_amount,
            'amount_payed' => $this->amount_payed,
            'due_amount' => $this->due_amount,
            'due_date' => $this->due_date,
            'payment_status' => $this->payment_status,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'sales_invoice_number', $this->sales_invoice_number])
                ->andFilterWhere(['like', 'busines_partner_code', $this->busines_partner_code])
                ->andFilterWhere(['like', 'salesman', $this->salesman])
                ->andFilterWhere(['like', 'payment_terms', $this->payment_terms])
                ->andFilterWhere(['like', 'delivery_terms', $this->delivery_terms])
                ->andFilterWhere(['like', 'ship_to_adress', $this->ship_to_adress])
                ->andFilterWhere(['like', 'reference', $this->reference])
                ->andFilterWhere(['like', 'error_message', $this->error_message])
                ->andFilterWhere(['>=', 'sales_invoice_date', $params["SalesInvoiceMasterSearch"]["createdFrom"]])
                ->andFilterWhere(['<=', 'sales_invoice_date', $params["SalesInvoiceMasterSearch"]["createdTo"]]);

        return $dataProvider;
    }

}
