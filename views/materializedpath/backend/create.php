<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\mp_Models\MpTree */

if (!isset($child)) {
    $this->title = 'Create Item';
} else {
    $this->title = 'Create Child';
}


$this->params['breadcrumbs'][] = ['label' => 'Mp Trees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mp-tree-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!isset($child)) { ?>
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    <?php } else { ?>
        <?=
        $this->render('_form_child', [
            'newModel' => $newModel,
            'path' =>  $newModel->path,
            'level' => $newModel->level,
        ])
        ?> 
    <?php } ?>

</div>
