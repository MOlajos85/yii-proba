<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $book_id
 * @property string $book_author
 * @property string $book_title
 * @property string $book_img
 * @property integer $book_price
 *
 * @property Orders[] $orders
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_author', 'book_title', 'book_price'], 'required'],
            [['book_price'], 'integer'],
            [['file'],'file'],
            [['book_author', 'book_title'], 'string', 'max' => 100],
            [['book_img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'book_author' => 'Author',
            'book_title' => 'Title',
            'book_price' => 'Price',
            'file' => 'Book Cover',
        ];
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['books_book_id' => 'book_id']);
    }

    // public function getCustomers() {
    //     return $this->hasMany(Customers::className(), ['book_id' => 'customers_customer_id'])
    //         ->viaTable('orders', ['books_book_id' => 'book_id']);
    // }
}
