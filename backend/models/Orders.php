<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property integer $customers_customer_id
 * @property integer $books_book_id
 *
 * @property Customers $customersCustomer
 * @property Books $booksBook
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    // Mezőkre vonatkozó megkötések
     public function rules()
    {
        return [
            [['customers_customer_id', 'books_book_id'], 'required'],
            [['customers_customer_id', 'books_book_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    // Oszlopok fejléce
     public function attributeLabels()
    {
        return [
            'order_id' => 'Rendelés azonosítója',
            'customers_customer_id' => 'Vásárló neve', // idegen kulcs kapcsolat a Customers táblával
            'books_book_id' => 'Könyv címe', // idegen kulcs kapcsolat a Books táblával
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    // Kapcsolat az Orders és a Customers tábla között
     public function getCustomersCustomer()
    {
        return $this->hasOne(Customers::className(), ['customer_id' => 'customers_customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    // Kapcsolat az Orders és a Books tábla között
    public function getBooksBook()
    {
        return $this->hasOne(Books::className(), ['book_id' => 'books_book_id']);
    }
}
