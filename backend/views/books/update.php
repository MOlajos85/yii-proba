<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Books */

$this->title = 'Könyv adatainak frissítése: ' . ' ' . $model->book_author.' - '. $model->book_title;
$this->params['breadcrumbs'][] = ['label' => 'Könyvek', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->book_id, 'url' => ['view', 'id' => $model->book_id]];
$this->params['breadcrumbs'][] = 'Frissítés';
?>
<div class="books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
