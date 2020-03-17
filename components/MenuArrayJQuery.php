<?php

namespace app\components;

use app\models\creocoderModel\Menu;

class MenuArrayJQuery {

    static function getData() {

        $collection = Menu::find()->orderBy('lft')->asArray()->all();
        
        //print_r($collection);

        $menu = [];

        if ($collection) {
            $nsTree = new NestedSetsTreeMenu();
            $dataMenu = $nsTree->tree($collection); //создаем дерево в виде массива
            // this version is OK
            MenuArrayJQuery::recursive_TreeMenu($dataMenu);

            MenuArrayJQuery::recursive_unset_ifempty($dataMenu, "items");

            $menu = $dataMenu;
        }

        return $menu;
    }

    static function setTreeNodeStates($display) {

        $collection = Menu::find()->orderBy('lft')->asArray()->all();

        $menu = [];

        if ($collection) {
            $nsTree = new NestedSetsTreeMenu();
            $dataMenu = $nsTree->tree($collection); //создаем дерево в виде массива
            // this version is OK
            MenuArrayJQuery::recursive_TreeNodeStates($dataMenu, $display);

            MenuArrayJQuery::recursive_unset_ifempty($dataMenu, "items");

            $menu = $dataMenu;
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
                MenuArray::recursive_unset_ifempty($value, $unwanted_key);
            }
        }
    }

    static function recursive_TreeMenu(&$array1) {

        foreach ($array1 as &$value) {
            if (is_array($value)) {

                if (array_key_exists('label', $value)) {
                    if (in_array($value['label'], $value)) {

                        $val = (int) $value['rgt'] - (int) $value['lft'];
                        //
                        if ($val == 1) {
                            $array2 = ['url' =>
                                '/index.php?r=menutest/countries&label=' . $value['label']];
                            $value += $array2;
                        } else {
                            $array2 = ['url' => '#'];
                            $value += $array2;
                        }

                        // set 'Country' visibility all time
                        if ($value['lft'] === "1") {
                            $value += ['display' => 'inline'];
                        } else {
                            $value += ['display' => 'none'];
                        }
                    }
                } else {
                    // array_push($value, "2222222");
                    // echo "CCC2::: " . count($value) . "    " . print_r($value);
                }
                MenuArrayJQuery::recursive_TreeMenu($value);
            }
        }
    }

    static function recursive_TreeNodeStates(&$array1, $display) {

        foreach ($array1 as &$value) {
            if (is_array($value)) {

                if (array_key_exists('label', $value)) {
                    if (in_array($value['label'], $value)) {
                        
                         $val = (int) $value['rgt'] - (int) $value['lft'];
                        //
                        if ($val == 1) {
                            $array2 = ['url' =>
                                '/index.php?r=menutest/countries&label=' . $value['label']];
                            $value += $array2;
                        } else {
                            $array2 = ['url' => '#'];
                            $value += $array2;
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
                MenuArrayJQuery::recursive_TreeNodeStates($value, $display);
            }
        }
    }

}
