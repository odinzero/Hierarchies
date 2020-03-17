<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NestedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nested Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nested-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nested Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'category_id',
            'name',
            'lft',
            'rgt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
