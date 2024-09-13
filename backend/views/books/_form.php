<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'create-book-form', // ezt az id-t használja a felugró ablak modal
            ['enctype' => 'multipart/form-data'] // fájl tárolásához kell
        ]
      ]); ?>

    <?= $form->field($model, 'book_author')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'book_title')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'book_price')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> 
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class'=>'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
