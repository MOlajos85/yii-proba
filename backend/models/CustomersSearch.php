<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customers;

/**
 * CustomersSearch represents the model behind the search form about `backend\models\Customers`.
 */
class CustomersSearch extends Customers
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['customer_id'], 'integer'],
            [['customer_name', 'globalSearch', 'zip_code', 'city', 'province'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Customers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // $query->andFilterWhere([
        //     'customer_id' => $this->customer_id,
        // ]);

        // $query->andFilterWhere(['like', 'customer_name', $this->customer_name])
        //     ->andFilterWhere(['like', 'zip_code', $this->zip_code])
        //     ->andFilterWhere(['like', 'city', $this->city])
        //     ->andFilterWhere(['like', 'province', $this->province]);
        
        $query->orFilterWhere(['like', 'customer_name', $this->globalSearch])
            ->orFilterWhere(['like', 'zip_code', $this->globalSearch])
            ->orFilterWhere(['like', 'city', $this->globalSearch])
            ->orFilterWhere(['like', 'province', $this->globalSearch]);

        return $dataProvider;
    }
}
