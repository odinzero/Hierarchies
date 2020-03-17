<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NestedCategory */

$this->title = 'Create Nested Category';
$this->params['breadcrumbs'][] = ['label' => 'Nested Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nested-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>
    
    <?php  
      if (isset($_POST)) {
          echo $id;
      }
    ?>
    
   <?php var_dump($_POST ); ?>

</div>
