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
    // Változó a feltötött fájlok tárolásához
     public $file;
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */

    // Mezőkre vonatkozó szabályok
    public function rules()
    {
        return [
            [['book_author', 'book_title', 'book_price'], 'required'],
            [['book_price'], 'integer'],
            [['file'],'file'], // a file mező fájl típusú
            [['book_author', 'book_title'], 'string', 'max' => 100],
            [['book_img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    // Az egyes mezők ilyen néven szerepelnek a nézetekben
     public function attributeLabels()
    {
        return [
            'book_id' => 'Könyv azonnosítója',
            'book_author' => 'Szerző',
            'book_title' => ' Könyv címe',
            'book_price' => 'Ár',
            'file' => 'Borítókép',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // Összekapcsolás az Orders kapcsolótáblával; books->book_id mező kapcsolása orders->books_book_id mezőhöz
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['books_book_id' => 'book_id']);
    }
}
