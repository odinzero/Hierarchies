<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\mp_Models\MpTree */

$this->title = 'Update Mp Tree: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mp Trees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mp-tree-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
