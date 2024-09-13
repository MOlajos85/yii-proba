<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $customer_id
 * @property string $customer_name
 * @property string $zip_code
 * @property string $city
 * @property string $province
 *
 * @property Orders[] $orders
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    // Mezőkre vonatkozó megkötések
     public function rules()
    {
        return [
            [['customer_name', 'zip_code', 'city', 'province'], 'required'],
            [['customer_name', 'city', 'province'], 'string', 'max' => 100],
            [['zip_code'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    // attributeLabels: az adott nézetben az adott oszlopnév beállítása (pl. vásárló neve Customer Name lesz)
     public function attributeLabels()
    {
        return [
            'customer_id' => 'Vásárlói azonosító',
            'customer_name' => 'Vásárló neve',
            'zip_code' => 'Irányítószám',
            'city' => 'Település',
            'province' => 'Megye',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // Összekapcsolás az Orders kapcsolótáblával; customers->customer_id mező kapcsolása orders->books_book_id mezőhöz
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['customers_customer_id' => 'customer_id']);
    }
}
