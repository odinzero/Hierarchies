<?php

use yii\helpers\Html;
use yii\web\View;
use app\assets\AppAsset;
use yii\web\JqueryAsset;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->head() ?>
        <?php
        $this->registerMetaTag(['name' => 'csrf-param', 'content' => Yii::$app->getRequest()->csrfParam], 'csrf-token');
        $this->registerMetaTag(['name' => 'csrf-token', 'content' => Yii::$app->getRequest()->getCsrfToken()], 'csrf-param');
        ?>
              <!--<script src="js/jquery.js"></script>-->
<?php echo Html::csrfMetaTags(); ?>
        <script>

        </script>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <!--Connect jquery script-->
        

        <script type="text/javascript">
            //Assign php generated json to JavaScript variable
            var tempArray = <?= json_encode($oldmenu); ?>;

            //You will be able to access the properties as 
            //alert(tempArray[0].Key);
        </script>

        <?php
        echo Html::csrfMetaTags();

      //  echo print_r($oldmenu);

        echo Html::tag('div', $node, ['id' => 'menu_tree']);

        // echo $tree;
//        $this->registerJs("$(document).on('click', 'a', function(e) {
//                               e.preventDefault(); 
//                               alert('h');
//                           });", View::POS_END );
        //var arrData = '<?php echo $data; >';
        // $this->registerJs("var arrData = '<?php echo json_encode($data).split(,); >'", View::POS_END );

        $this->registerJs("$(document).on('click', 'a.ajax', handleAjaxLink );", View::POS_END );

        $this->registerJs("$('li .current').css('background','red');", View::POS_END );
        ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>







