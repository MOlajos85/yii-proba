<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'create-customer-form'
        ]
    ]); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Létrehozás' : 'Frissítés', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Mégse'), ['index'], ['class'=>'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
