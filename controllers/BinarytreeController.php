<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BinarytreeController extends Controller {
    
     public $layout = 'main_binarytree';
  
     public function actionIndex() {
         
        $tree = Yii::$app->BSTcheck->testTree();
       
       // $tree = Yii::$app->BinaryCell->generateCell();
         
        // print_r($tree);
         
        //return $this->render('index');
    }
    
     public function actionViewtree() {
         
         return $this->render('tree');
     }
}
