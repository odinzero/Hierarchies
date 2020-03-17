<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AjacentlistController extends Controller {
    
     public $layout = 'main_al';
    
     public function actionViewtree() {
         
         return $this->render('tree_open');
     }
     
      public function actionCategories() {  
        
        if (!isset($_POST['id'])) {
             return $this->render('tree_closed' );
        } else {
            $display_states = $_POST['id'];
            
            $arr_selectedCategory = $_POST['selectedCategory'];
            $selectedCategory = "";
            foreach ($arr_selectedCategory as $key => $value) {
                $selectedCategory = $value;
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
            
         //   print_r($display);
//            die();

            $tree = Yii::$app->MenuArrayAL::setTreeNodeStates($display);
           
            return $this->render('tree_closed', [
                'tree' => $tree,
                'selectedCategory' => $selectedCategory
                    ] );
        }

    }
}

