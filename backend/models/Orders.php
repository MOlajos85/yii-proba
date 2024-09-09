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
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'customers_customer_id' => 'Customer Name',
            'books_book_id' => 'Book',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersCustomer()
    {
        return $this->hasOne(Customers::className(), ['customer_id' => 'customers_customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksBook()
    {
        return $this->hasOne(Books::className(), ['book_id' => 'books_book_id']);
    }
}
