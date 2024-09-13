<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Books */

$this->title = $model->book_author.' - '. $model->book_title;
$this->params['breadcrumbs'][] = ['label' => 'Könyvek', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'book_id',
            'book_author',
            'book_title',
            'book_img',
            'book_price',
        ],
    ]) ?>

</div>
