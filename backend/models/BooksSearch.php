<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Books;

/**
 * BooksSearch represents the model behind the search form about `backend\models\Books`.
 */
class BooksSearch extends Books
{
    /**
     * @inheritdoc
     */
    public $customer_name;
    public function rules()
    {
        return [
            [['book_id', 'book_price'], 'integer'],
            [['book_author', 'customer_name', 'book_title'], 'safe'],
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
        $query = Books::find();
        // $query = Books::find()->innerJoinWith('customers', true);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'book_id' => $this->book_id,
            'book_price' => $this->book_price,
        ]);

        $query->andFilterWhere(['like', 'book_author', $this->book_author])
            ->andFilterWhere(['like', 'book_title', $this->book_title])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name]);

        return $dataProvider;
    }
}
