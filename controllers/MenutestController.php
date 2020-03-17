<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class MenutestController extends Controller {

  //  public $layout = 'main_menutest';
    public $layout = 'main_dragdrop';

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCountries() {  // $label
        // return $this->render("//countries/$label");
        // $post = $_POST[];
        print_r($_POST);
        echo "HHH";

        // return $this->render("countries/$label");
    }

    public function actionCountries2() {  // $label
        
        if (!isset($_POST['id'])) {
             return $this->render('//dragdropnested/view_tree_jquery' );
        } else {
            $display_states = $_POST['id'];
            
            $arr_selectedCountry = $_POST['selectedCountry'];
            $selectedCountry = "";
            foreach ($arr_selectedCountry as $key => $value) {
                $selectedCountry = $value;
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

            $tree = Yii::$app->MenuArrayJQuery::setTreeNodeStates($display);

           
            return $this->render('//dragdropnested/view_tree_jquery', [
                'tree' => $tree,
                'selectedCountry' => $selectedCountry
                    ] );
        }

    }

}
