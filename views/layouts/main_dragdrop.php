<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
    <?php $this->registerJsFile('js/utils.js', ['position' => View::POS_HEAD]); ?>
    <?php $this->registerJsFile('js/js1.js', ['position' => View::POS_HEAD]); ?>
    <?php $this->registerJsFile('js/mp.js', ['position' => View::POS_HEAD]); ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Hierarchii',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'MyNestedSet', 'url' => ['/nested/menu']],
            ['label' => 'CreoNested', 'url' => ['/creocodernested/index']],
            ['label' => 'DragDropNested(1)', 'url' => ['/dragdropnested/index']],
            ['label' => 'TreeMenu(2)(NOK)', 'url' => ['/dragdropnested/treemenu']],
            ['label' => 'TreeMenu(3)(OK)', 'url' => ['/dragdropnested/treemenu_jquery']],
            ['label' => '=Menu=(4)(NOK)', 'url' => ['/menutest/index']],
            ['label' => 'BinaryTree', 'url' => ['/binarytree/viewtree']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
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
