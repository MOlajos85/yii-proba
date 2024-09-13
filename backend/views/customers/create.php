<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Customers */

$this->title = 'Új vásárló létrehozása';
$this->params['breadcrumbs'][] = ['label' => 'Vásárlók', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
