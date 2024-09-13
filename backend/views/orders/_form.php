<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Customers;
use backend\models\Books;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'create-order-form'
        ]
    ]); ?>

    <?= $form->field($model, 'customers_customer_id')->dropDownList(
        ArrayHelper::map(Customers::find()->all(), 'customer_id', 'customer_name'),
        ['prompt' => 'Vásárló neve']
    ) ?>

    <?= $form->field($model, 'books_book_id')->dropDownList(
        ArrayHelper::map(Books::find()->all(), 'book_id', 'book_title'),
        ['prompt' => 'Könyv címe']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Felvétel' : 'Frissítés', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Mégse'), ['index'], ['class'=>'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
