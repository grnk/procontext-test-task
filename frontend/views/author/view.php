<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Author */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Author').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'booksCount'
//        'order',
//        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    
    <div class="row">
<?php
if($providerAuthorBook->totalCount){
    $gridColumnAuthorBook = [
        ['class' => 'yii\grid\SerialColumn'],
                        [
                'attribute' => 'book.title',
                'label' => Yii::t('app', 'Book')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerAuthorBook,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-author-book']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Author Book')),
        ],
        'export' => false,
        'columns' => $gridColumnAuthorBook
    ]);
}
?>

    </div>
</div>
