<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Url;
use yii\widgets\Pjax; // Ajax küldés
use yii\bootstrap\Modal; // Felugró ablak az űrlap kitöltéséhez

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
        <!-- <?= Html::button('Create Orders', ['value' =>Url::to('index.php?r=orders/create'), 'class' => 'btn btn-success', 'id' => 'ordersModalButton']) ?> -->
        <?= Html::button('Create Orders', ['value' =>Url::to('index.php?r=orders/create'), 'title' => 'Create Order', 'class' => 'showModalButton btn btn-success']) ?>
    </p>

    <!-- <?php
        // Felugró űrlap ablak
        Modal::begin([
            'header' => '<h4>Orders</h4>',
            'id' => 'ordersModal',
            'size' => 'modal-lg',
        ]);

        echo "<div id='ordersModalContent'></div>";

        Modal::end();
    ?> -->

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

    <!-- Keresés Ajax-szel, az oldal újratöltése nélkül -->
     <!-- Pjax widget, kezdés: begin(), zárás: end() -->
    <?php Pjax::begin(); ?>
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
    <?php Pjax::end(); ?>
</div>