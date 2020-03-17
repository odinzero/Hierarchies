<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $query \yii\db\ActiveQuery */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    #menu-ajacent-list, #menu-ajacent-list ul {
        list-style:  none;
    }
    #menu-ajacent-list li {
        margin-top: 10px;
    }
</style>

<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('Create new item', ['create'], ['class' => 'btn btn-default']) ?></p>

    <?php
    $this->registerJs("$(document).on('click', '#menu-ajacent-list a', menuClick_al );", View::POS_END);
    // other clicks
    $this->registerJs("$(document).on('click', '#menu-ajacent-list a[href^=\'/index.php\']', submitForm_al );", View::POS_END);
    ?>


    <?php // Html::beginForm(['/dragdropnested/treemenu2'], 'post', ['id' => "menu-tree-jquery-form" ])  ?>

    <?php // if (!isset($_POST['id'])) { ?>
    <?php
    if (!isset($_POST['id'])) {
        $items = Yii::$app->MenuArrayAL::createOpenTree();
     } else {
        $items = $tree;
    }
    ?>
    <?= Html::beginForm(['/menutest/countries2'], 'post', ['id' => "menu-ajacent-list-form"]) ?>
    <?=
    
       Yii::$app->MyMenu::widget([
        'items' => $items,
        'options' => ['id' => 'menu-ajacent-list', 'class' => 'navbar'],
        'encodeLabels' => false,
        'activateParents' => true,
        'activeCssClass' => 'active',
        'linkTemplate' => '<a href="{url}" id="_{id}" class="btn btn-info" style="display: {display};" >{label}</a>',
    ]);
      
    ?>
    <?= Html::endForm(); ?>

  
      

