<?php

namespace app\components\ajacent_list;

use app\models\ajacentList\Category;

class MenuArrayAL {

    static function createOpenTree() {

        $collection = Category::find()->orderBy('id')->asArray()->all();

        $menu = [];

        if ($collection) {

            $alTree = MenuArrayAL::buildOpenedTree($collection);

            // print_r($alTree);

            $menu = $alTree;
        }

        return $menu;
    }
    
     static function createClosedTree() {

        $collection = Category::find()->orderBy('id')->asArray()->all();

        $menu = [];

        if ($collection) {

            $alTree = MenuArrayAL::buildClosedTree($collection);

           // print_r($alTree);

            $menu = $alTree;
        }

        return $menu;
    }

    static function setTreeNodeStates($display) {

        $collection = Category::find()->orderBy('id')->asArray()->all();

        $menu = [];

        if ($collection) {

            // MenuArrayMP::recursive_TreeNodeStates($dataMenu, $display);

            $alTree = MenuArrayAL::buildTreeNodes($collection, 0, $display);

            // print_r($alTree);

            $menu = $alTree;
        }

        return $menu;
    }

    public static function buildOpenedTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {

            $array = ['url' =>
                '/index.php?r=ajacentlist/categories&label=' . $element['name']];
            $element += $array;
            $element += ['display' => 'inline'];
            $element += ['label' => $element['name']];

            if ($element['parent_id'] == $parentId) {
                $children = MenuArrayAL::buildOpenedTree($elements, $element['id']);
                if ($children) {
                    $element['items'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public static function buildClosedTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {

            $array = ['url' =>
                '/index.php?r=ajacentlist/categories&label=' . $element['name']];
            $element += $array;
            $element += ['label' => $element['name']];

            if ($element['name'] === "ROOT") {
                $element += ['display' => 'inline'];
            } else {
                $element += ['display' => 'none'];
            }

            if ($element['parent_id'] == $parentId) {
                $children = MenuArrayAL::buildClosedTree($elements, $element['id']);
                if ($children) {
                    $element['items'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public static function buildTreeNodes(array $elements, $parentId = 0, $display) {
        $branch = array();

        foreach ($elements as $element) {

            $array = ['url' =>
                '/index.php?r=ajacentlist/categories&label=' . $element['name']];
            $element += $array;
            $element += ['label' => $element['name']];

            foreach ($display as $key => $val) {
                if ($element['id'] === "" . $key) {
                    $element += ['display' => $val];
                }
            }

            if ($element['parent_id'] == $parentId) {
                $children = MenuArrayAL::buildTreeNodes($elements, $element['id'], $display);
                if ($children) {
                    $element['items'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

}
