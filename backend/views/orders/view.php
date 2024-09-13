<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = 'Rendelés száma: '.$model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Rendelések', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <!-- Cím -->
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Ezek az oszlopok látszódnak -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customersCustomer.customer_name',
            'booksBook.book_title'
        ],
    ]) ?>

</div>
