<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerJsFile('js/jquery.js', ['position' => View::POS_HEAD]); ?>
    <?php $this->registerJsFile('js/ajax.js', ['position' => View::POS_HEAD]); ?>
    <?php $this->registerJsFile('js/js1.js', ['position' => View::POS_HEAD]); ?>
     <?php
    $this->registerJs("$(document).on('click', '#main-menu-jquery a[href=\'#\']', menuClick2 );", View::POS_END );
    // other clicks
    $this->registerJs("$(document).on('click', '#main-menu-jquery a[href^=\'/index.php\']', submitForm_ns );", View::POS_END );
    ?>
    <style>
        #main-menu-jquery, #main-menu-jquery ul {
            list-style:  none;
        }
        #main-menu-jquery li {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container col-4">
     <?= Html::beginForm(['/menutest/countries2'], 'post', ['id' => "menu-tree-jquery-form" ]) ?> 
         <?php $form = ActiveForm::begin([
        'id' => 'menu-tree-jquery-form',
        'layout' => 'horizontal',
    ]); ?>
     <?=   
     Yii::$app->MyMenu::widget([ 
        'items' => Yii::$app->MenuArrayJQuery::getData(),
        'options' => ['id' => 'main-menu-jquery',
                      'class' => 'dropdown', 
                      'style'=>'margin-top: 10px;' ],
        'encodeLabels' => false,
        'activateParents' => true,
        'activeCssClass' => 'active',
        'linkTemplate' => '<a href="{url}" id="_{id}" class="btn btn-primary" style="display: {display};" >{label}</a>',
        ]);
    ?>
    <?= Html::endForm() ?>  
    </div>
    <div class="container col-8">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
