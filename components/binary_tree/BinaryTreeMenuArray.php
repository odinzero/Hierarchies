<?php

namespace app\components\binary_tree;

use app\models\binaryModels\BinaryTree;

class BinaryTreeMenuArray {
    
    static function createTree( ) {
        
        $collection = BinaryTree::find()->orderBy('path')->asArray()->all();

        $menu = [];

        if ($collection) {
            $btTree = new BinaryTreeMenu();
            $dataMenu = $btTree->tree($collection); //создаем дерево в виде массива
            
            BinaryTreeMenuArray::recursive_TreeMenu($dataMenu);

            BinaryTreeMenuArray::recursive_unset_ifempty($dataMenu, "items");
            
            print_r($dataMenu);

            $menu = $dataMenu;
        }

        return $menu;
    }
    
    static function setTreeNodeStates($display) {

        $collection = MpTree::find()->orderBy('path')->asArray()->all();

        $menu = [];

        if ($collection) {
            $nsTree = new MatPathTreeMenu();
            $dataMenu = $nsTree->tree($collection); //создаем дерево в виде массива
            // this version is OK
            BinaryTreeMenuArray::recursive_TreeNodeStates($dataMenu, $display);

            BinaryTreeMenuArray::recursive_unset_ifempty($dataMenu, "items");

            $menu = $dataMenu;
            
           // print_r($dataMenu);
        }

        return $menu;
    }
    
     // ok
    static function recursive_unset_ifempty(&$array, $unwanted_key) {
        // remove element if it is empty 
        if (empty($array[$unwanted_key])) {
            unset($array[$unwanted_key]);
        }
        foreach ($array as &$value) {
            if (is_array($value)) {
                BinaryTreeMenuArray::recursive_unset_ifempty($value, $unwanted_key);
            }
        }
    }
    
    static function recursive_TreeMenu(&$array1) {

        foreach ($array1 as &$value) {
            if (is_array($value)) {

                if (array_key_exists('label', $value)) {
                    if (in_array($value['label'], $value)) {

                       // $val = (int) $value['rgt'] - (int) $value['lft'];
                        //
//                        if ($val == 1) {
                            $array2 = ['url' =>
                                '/index.php?r=materializedpath/food&label=' . $value['label']];
                            $value += $array2;
//                        } else {
//                            $array2 = ['url' => '#'];
//                            $value += $array2;
//                        }
                            if($value['position'] === "1") {
                                $value['position'] = "L";
                            }
                             if($value['position'] === "2") {
                                $value['position'] = "R";
                            }

                        // set 'Food' visibility all time
//                        if ($value['level'] === "0") {
                            $value += ['display' => 'inline'];
//                        } else {
//                            $value += ['display' => 'none'];
//                        }
                    }
                } else {
                    // array_push($value, "2222222");
                    // echo "CCC2::: " . count($value) . "    " . print_r($value);
                }
                BinaryTreeMenuArray::recursive_TreeMenu($value);
            }
        }
    }
    
    
     static function recursive_TreeNodeStates(&$array1, $display) {

        foreach ($array1 as &$value) {
            if (is_array($value)) {

                if (array_key_exists('label', $value)) {
                    if (in_array($value['label'], $value)) {
                        
                        //
//                        if ($val == 1) {
                            $array2 = ['url' =>
                                '/index.php?r=materializedpath/food&label=' . $value['label']];
                            $value += $array2;
//                        } else {
//                            $array2 = ['url' => '#'];
//                            $value += $array2;
//                        }
                            
                         if($value['position'] === "1") {
                                $value['position'] = "L";
                            }
                             if($value['position'] === "2") {
                                $value['position'] = "R";
                            }    

                        foreach ($display as $key => $val) {
                            if ($value['id'] === "" . $key) {
                                $value += ['display' => $val];
                            }
                        }
                    } else {
                        // array_push($value, "2222222");
                        // echo "CCC2::: " . count($value) . "    " . print_r($value);
                    }
                }
                BinaryTreeMenuArray::recursive_TreeNodeStates($value, $display);
            }
        }
    }
    
}