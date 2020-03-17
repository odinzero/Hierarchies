<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NestedCategory */

$this->title = 'Update Nested Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nested Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->category_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nested-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $model->category_id,
    ]) ?>

</div>
