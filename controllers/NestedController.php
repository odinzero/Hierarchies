<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\NestedCategoryModel;

class NestedController extends Controller {
    
    public $layout = 'main';

    // RETRIEVING A FULL TREE
    // http://localhost:8888/index.php?r=nested/index
    public function actionIndex() {

        $connection = Yii::$app->MyDbConnection->connection();
        $connection->open();

        $command0 = $connection
                ->createCommand("
                        SELECT * FROM nested_category ORDER BY category_id ");

        $data = $command0->queryAll();

        // var_dump($data);
        return $this->render('nested_category', ['data' => $data]);
    }

    // $id = 1
    // http://localhost:8888/index.php?r=nested/menu
    public function actionMenu() {

        $connection = Yii::$app->MyDbConnection->connection();
        $connection->open();

        $command0 = $connection
                ->createCommand("SELECT node.name, (COUNT(parent.name) - 1) AS depth
            FROM nested_category AS node
            CROSS JOIN nested_category AS parent
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
            GROUP BY node.name
            ORDER BY node.lft");

        $data = $command0->queryAll();
        // create list <ul> .. <li> .. <ul>
        $tree = Yii::$app->MyNestedSetComponent->makeTreeList($data);

        return $this->render('menu', ['data' => $data, 'tree' => $tree]);
    }

    // FIND THE IMMEDIATE SUBORDINATES OF A NODE
    // http://localhost:8888/index.php?r=nested%2Fsubmenu&category=ELECTRONICS&depth=1
    public function actionSubmenu($category, $depth) {
        
        $connection = Yii::$app->MyDbConnection->connection();
        $connection->open();

        $command0 = $connection
                ->createCommand("SELECT node.name, node.category_id, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
                    FROM nested_category AS node,
                    nested_category AS parent,
                    nested_category AS sub_parent,
                    (
                           SELECT node.name, (COUNT(parent.name) - 1) AS depth
                           FROM nested_category AS node,
                           nested_category AS parent
                           WHERE node.lft BETWEEN parent.lft AND parent.rgt
                           AND node.name = '" . $category . "'
                           GROUP BY node.name
                           ORDER BY node.lft
                    ) AS sub_tree
                   WHERE node.lft BETWEEN parent.lft AND parent.rgt
                   AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
                   AND sub_parent.name = sub_tree.name
                    GROUP BY node.name
                    HAVING depth <= " . $depth . 
                    " ORDER BY node.lft;");

        $data = $command0->queryAll();
        // create list <ul> .. <li> .. <ul>
        $node = Yii::$app->MyNestedSetComponent->makeTreeListRef($data);
        
        $oldmenu = $data;
        //print_r($data);

        return $this->render('submenu', ['data' => $data, 'node' => $node, 'oldmenu' => $oldmenu ]);
        //return $this->render('submenu', ['data' => $data ] );
    }
    
    // for AJAX
    public function actionNode($category, $depth) {

        $connection = Yii::$app->MyDbConnection->connection();
        $connection->open();
       
        $command0 = $connection
                ->createCommand("SELECT node.name, node.category_id, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
                    FROM nested_category AS node,
                    nested_category AS parent,
                    nested_category AS sub_parent,
                    (
                           SELECT node.name, (COUNT(parent.name) - 1) AS depth
                           FROM nested_category AS node,
                           nested_category AS parent
                           WHERE node.lft BETWEEN parent.lft AND parent.rgt
                           AND node.name = '" . $category . "'
                           GROUP BY node.name
                           ORDER BY node.lft
                    ) AS sub_tree
                   WHERE node.lft BETWEEN parent.lft AND parent.rgt
                   AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
                   AND sub_parent.name = sub_tree.name
                    GROUP BY node.name
                    HAVING depth = " . $depth .
                    " ORDER BY node.lft;");

        $data = $command0->queryAll();
        // create list <ul> .. <li> .. <ul>
        $node = Yii::$app->MyNestedSetComponent->makeTreeListRef($data);
        
        //print_r($data);
        return $node;
    }
    
    
    public function actionArr() {
        
//      [1] => Array ( [name] => TELEVISIONS [category_id] => 2 [depth] => 1 )
//      [2] => Array ( [name] => PORTABLE ELECTRONICS [category_id] => 6 [depth] => 1   
        
     $root = Array ( 0 => Array ( "name" => "ELECTRONICS", "category_id" => 1, "depth" => 0 ),
                     1 => Array ( "name" => "TELEVISIONS", "category_id" => 2, "depth" => 1 ),
                     2 => Array ( "name" => "PORTABLE ELECTRONICS", "category_id" => 6, "depth" => 1) );
     
     foreach ($root as $v1) {
         foreach ($v1 as $k => $v ) {
             
             echo   $v . "  ";
             
         } 
     }
    }
    
    

    protected function findNestedCategoryModel($id) {
        if (($model = NestedCategoryModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
