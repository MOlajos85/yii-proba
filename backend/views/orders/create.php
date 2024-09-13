<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = 'Új rendelés felvétele';
$this->params['breadcrumbs'][] = ['label' => 'Rendelések', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
