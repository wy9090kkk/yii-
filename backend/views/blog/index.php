<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Blog;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'content:ntext',
            'views',
            'is_delete',
            [
                'attribute' => 'category',
                'value' => function ($model) {
                    // echo '<pre>';
                    // print_r($model->getRelatedRecords());
                    $a = $model->getRelatedRecords()['category'];
                    $tagName="";
                    foreach ($a as $key => $value) { 
                        // var_dump($value->name);                       
                        $tagName.=$value->name.'/';
                    }
                    return rtrim($tagName,'/'); 
                }
            ],
            'create_at',
            'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
