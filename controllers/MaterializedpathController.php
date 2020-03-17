<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class MaterializedpathController extends Controller {
    
    public $layout = 'main_mp';
    
    public function actionIndex() {
        
         $tree = Yii::$app->MenuArrayMP::createTree();
         
        // print_r($tree);
         
        return $this->render('index');
    }
    
    public function actionFood() {  // $label
        
        if (!isset($_POST['id'])) {
             return $this->render('index' );
        } else {
            $display_states = $_POST['id'];
            
            $arr_selectedFood = $_POST['selectedFood'];
            $selectedFood = "";
            foreach ($arr_selectedFood as $key => $value) {
                $selectedFood = $value;
            }

//            $display = array('9' => 'inline',
//                             '11' => 'inline',
//                             '10' => 'none',
//                             '12' => 'inline',
//                             '13' => 'inline',
//                             '16' => 'none',
//                             '14' => 'inline', 
//                             '15' => 'inline');
            
            $display = array();
            foreach ($display_states as $key => $value) {
                // echo $key . "   " . $value ; 
                $display += ["$key" => $value];
            }

            $tree = Yii::$app->MenuArrayMP::setTreeNodeStates($display);

           
            return $this->render('index', [
                'tree' => $tree,
                'selectedFood' => $selectedFood
                    ] );
        }

    }
    
}

