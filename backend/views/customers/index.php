<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vásárlók';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('create-customer')) {
              echo Html::button('Új vásárló', ['value' =>Url::to('index.php?r=customers/create'), 
              'title' => 'Új vásárló',
              'class' => 'showModalButton btn btn-success']);
            }
            else {
              echo Html::button('Új vásárló', ['value' =>Url::to('index.php?r=customers/create'), 
              'title' => 'Új vásárló',
              'class' => 'showModalButton btn btn-success',
              'disabled' => 'disabled'
              ]);
            }
    ?>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'customer_name',
            'zip_code',
            'city',
            'province',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
