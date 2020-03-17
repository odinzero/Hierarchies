<?php

//use Yii;
use yii\helpers\Html;
use yii\web\View;
//use yii\widgets\Menu;


/* @var $query \yii\db\ActiveQuery */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('Create new item', ['create'], ['class' => 'btn btn-default']) ?></p>


    <?php //echo "VIEW: " . print_r(Yii::$app->MenuArray::getData()); ?>

    <?php
    $menuItems = [
        ['label' => 'Home', 'url' => ['/']],
        ['label' => 'Products', 'url' => ['product/index'], 'items' => [
                ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
                ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            ]],
    ];
    
//     $menuItems = [
//        ['label' => 'Countries', 'items' => [
//            ['label' => 'Russia', 'items' => [
//               ['label' => 'New Zeeland' ], 
//            ]], 
//        ] ],
//    ];
    
//    print_r($menuItems);
//    $url = Yii::$app->MyCrudOperations->url_action(9, "create");
//    
//    echo $url ;
    
     $this->registerJs("$(document).on('click', '#main-menu a', menuClick );", View::POS_END );
   
    ?>


    <br><br><br>
    <?= Html::beginForm(['/dragdropnested/treemenu2'], 'post', ['id' => "menu-tree-form" ]) ?>
    <?=
      Yii::$app->MyMenu::widget([
        'items' => $tree,  
       // 'items' => Yii::$app->MenuArray::defineMenuOptionData($display),
        'options' => ['id' => 'main-menu', 'class' => 'navbar'],
        'encodeLabels' => false,
        'activateParents' => true,
        'activeCssClass' => 'active',
        //'labelTemplate' =>'{label} Label',
        //'linkTemplate' => '<div>{label}</div>',
         //добавление атрибута data-method
       // 'linkTemplate' => '<a href="{url}"  style="display: {display};" >{label}</a>',
           'linkTemplate' => '<a href="{url}" id="_{id}" style="display: {display};" >{label}</a>',
        
        ]);
    ?>
    <?= Html::endForm() ?>
