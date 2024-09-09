<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// Oldal neve
$this->title = 'Orders';

// Home - Orders sáv fenn
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- A felvett rendelések táblázata  -->
<div class="orders-index"> 

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!-- ExportMenu - MEGNÉZNI!!! -->
    <?php 
    
        $gridColumns = [
            'customersCustomer.customer_name',
            'orders_order_id',
            'books_book_id'
        ];

        // echo ExportMenu::widget([
        //     'dataProvider'=> $dataProvider,
        //     'columns' => $gridColumns
        // ]);
    
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        // A táblázatos lista a 'columns'-ben szerepel
        'columns' => [

            // 2 oszlop, mindkettő másik táblából jelenít meg adatokat; OrdersSearch modellben kifejtve
            // attribute: orders tábla melyik mezője alapján keres
            // value: melyik tábla melyik mezőjét figyeli (pl. vásárló neve a customers táblából)
            [
                'attribute' => 'customers_customer_id',
                'value' => 'customersCustomer.customer_name'
            ],

            [
                'attribute' => 'books_book_id',
                'value' => 'booksBook.book_title'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
