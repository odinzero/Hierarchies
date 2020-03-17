<?php

use yii\helpers\Html;
use klisl\nestable\Nestable;
use yii\helpers\Url;

/* @var $query \yii\db\ActiveQuery */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('Create new item', ['create'], ['class' => 'btn btn-default']) ?></p>

    <?= Nestable::widget([
        'type' => Nestable::TYPE_WITH_HANDLE,
        'query' => $query,
        'modelOptions' => [
            'name' => 'name', //поле из БД с названием элемента (отображается в дереве)
        ],
        'pluginEvents' => [
            'change' => 'function(e) {}', //js событие при выборе элемента
        ],
        'pluginOptions' => [
            'maxDepth' => 10, //максимальное кол-во уровней вложенности
        ],
        'update' => Url::to(['dragdropnested/update']), //действие по обновлению
        'delete' => Url::to(['dragdropnested/delete']), //действие по удалению
        'viewItem' => Url::to(['dragdropnested/view']), //действие по удалению
    ]);
    ?>

    <div id="nestable-menu">
        <button class="btn btn-default" type="button" data-action="expand-all">Expand All</button>
        <button class="btn btn-default" type="button" data-action="collapse-all">Collapse All</button>
    </div>

</div>