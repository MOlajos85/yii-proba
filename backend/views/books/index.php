<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Könyvek';

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (Yii::$app->user->can('create-book')) {
              echo Html::button('Új könyv', ['value' =>Url::to('index.php?r=books/create'), 
              'title' => 'Új könyv',
              'class' => 'showModalButton btn btn-success']);
            }
            else 
            {
              echo Html::button('Új könyv', ['value' =>Url::to('index.php?r=books/create'), 
              'title' => 'Új könyv',
              'class' => 'showModalButton btn btn-success',
              'disabled' => 'disabled'
            ]);
            }
    ?>

    <?php Pjax::begin(); ?>

    <?php echo $this->renderAjax('_search', ['model' => $searchModel]);?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'book_author',
            'book_title',
            'book_price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
