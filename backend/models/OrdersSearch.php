<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;
use yii\data\SqlDataProvider;

/**
 * OrdersSearch represents the model behind the search form about `backend\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */

     public $globalSearch;
    // Mezőkre vonatkozó megkötések
     public function rules()
    {
        return [
            // order_id-t integerként kezeli, a másik 2-t stringként
            [['order_id'], 'integer'],
            [['customers_customer_id', 'globalSearch', 'books_book_id'], 'safe']
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
    
    // Keresés a táblázat rekordaiban
    public function search($params)
    {
        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // RENDEZÉS VÁSÁRLÓ NEVE ÉS KÖNYVCÍM ALAPJÁN

        // Customers és Books tábla csatolása, mert a szükséges mezők (customer_name, book_title) ezekben vannak
        $query->joinWith('customersCustomer');
        $query->joinWith('booksBook');

        // A hivatkozott mezőket táblanév.mező_neve alakban adjuk meg
        $dataProvider->setSort([
            'attributes' => [
                'customers_customer_id'=>[
                    'asc'=>['customers.customer_name'=>SORT_ASC],
                    'desc'=>['customers.customer_name'=>SORT_DESC],
                ],
                'books_book_id'=>[
                    'asc'=>['books.book_title'=>SORT_ASC],
                    'desc'=>['books.book_title'=>SORT_DESC],
                ],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // KERESÉS OSZLOPNEVEK ALAPJÁN

        // Integer típus esetén, ahol pontos egyezés kell
        $query->andFilterWhere([
            'order_id' => $this->order_id,
        ]);

        // Stringeknél ('like')
        // A megadott id (pl. books_book_id) alapján keressen egyezést a csatolt táblában (pl. könyv címe alapján)
        $query->orFilterWhere(['like','customers.customer_name', $this->globalSearch])
                ->orFilterWhere(['like','books.book_title', $this->globalSearch]);

        return $dataProvider;
    }
}
