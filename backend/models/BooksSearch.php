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
    // public $customer_name;
    
    // Változó a globális keresés megvalósításához
    public $globalSearch;

    // Szabályok
    public function rules()
    {
        return [
            [['book_id', 'book_price'], 'integer'],
            [['book_author', 'globalSearch', 'book_title'], 'safe'],
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

    // Keresés megvalósítása
    public function search($params)
    {
        $query = Books::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        // a globalSearch alapján keres egyezést a cím, a szerző vagy az ár alapján
        $query->orFilterWhere(['like', 'book_author', $this->globalSearch])
            ->orFilterWhere(['like', 'book_title', $this->globalSearch])
            ->orFilterWhere(['like', 'book_price', $this->globalSearch]);

        return $dataProvider;
    }
}
