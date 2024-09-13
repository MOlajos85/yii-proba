<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- Az eredeti mezőket töröltük, helyettük van a globális keresés -->
    <?= $form->field($model, 'globalSearch') ?>

    <div class="form-group">
        <?= Html::submitButton('Keresés', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Visszaállítás', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
