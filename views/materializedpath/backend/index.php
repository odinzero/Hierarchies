<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\mp_Models\MpTreeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materialized Path Trees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mp-tree-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'path',
            'level',

            ['class' => 'yii\grid\ActionColumn',
              'template' => '{view} {update} {delete} {link}',
            'buttons' => [
                'update' => function ($url,$model) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-screenshot"></span>', 
                    $url);
                },
                'link' => function ($url,$model,$key) {
                    $url1 = "?r=mptree/createchild&id=".$model['id'];
                    return Html::a('Create child', $url1);
                },   
                
                ]
              ],
        ],
    ]);
       
                // print_r(Yii::$app->request->queryParams);
                ?>
</div>
