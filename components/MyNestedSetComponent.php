<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use app\models\TreeHierarhy;

class MyNestedSetComponent extends Component {

    public function loadModel() {
        return $model = NestedCategoryModel::find()->orderBy('category_id')->all();
    }

    /**
     *
     * Render a nested set into a HTML list
     *
     * @param       array   $tree
     * @return      string  the formated tree
     *
     */
    function makeTreeList(array $tree, $css_class = 'menu') {
        $result = '<ul class="' . $css_class . '">';
        $currDepth = 0;

        $css = 'info';

        foreach ($tree as $item) {
            if ($item['depth'] > $currDepth) {
                $result .= '<ul>'; // open sub tree if level up
            }

            if ($item['depth'] < $currDepth) {
                $result .= str_repeat("</ul></li>", $currDepth - $item['depth']); // close sub tree if level down
            }

            $result .= "<li>$item[name]</li>";
            $currDepth = $item['depth'];
        }
        $result .= "</ul>";
        return $result;
    }

    function makeTreeListRef(array $tree, $css_class = 'menu') {
        $result = '<ul class="' . $css_class . '"  >';
        $currDepth = 0;

        $css = 'info';

        foreach ($tree as $item) {

            $element_id = preg_replace('/\s+/', '_', $item['name']);

            if ($item['depth'] > $currDepth) {
                $result .= "<ul id='sub_$element_id'>"; // open sub tree if level up
            }

            if ($item['depth'] < $currDepth) {
                $result .= str_repeat("</ul></li>", $currDepth - $item['depth']); // close sub tree if level down
            }

            $url = $this->_url_action('node', $item['name'], $item['depth']);
            
            $crud = $this->addCrudActions($item['category_id']);

            $result .= "<li id='li_$element_id'>"
                    . '<a href="' . $url . '" class="ajax"  data-on-done = "simpleDone" >' . $item['name'] . "</a>&nbsp;"
                    . $crud
                    . "</li>"
                    . "<ul id='$element_id'></ul>";
            $currDepth = $item['depth'];
        }
        $result .= "</ul>";
        return $result;
    }

    function addCrudActions($v) {

        $url_v = $this->url_action2($v, 'view');
        $url_c1 = $this->url_action2($v, 'createchild');
        $url_c2 = $this->url_action2($v, 'createnonchild');
        $url_u = $this->url_action2($v, 'update');
        $url_d = $this->url_action2($v, 'delete');

        $out = "";

        $out .= '<a href="' . $url_v . '" class="nonajax"  title="View" aria-label="View" data-pjax="0" >'
                . '<span class="glyphicon glyphicon-th-list"></span></a>&nbsp;';

        $out .= '<a href="' . $url_c1 . '"  class="nonajax" title="Create child" aria-label="Create" data-pjax="0" >'
                . '<span class="glyphicon glyphicon-file"></span></a>&nbsp;';
        
        $out .= '<a href="' . $url_c2 . '"  class="nonajax" title="Create non child" aria-label="Create" data-pjax="0" >'
                . '<span class="glyphicon glyphicon-file"></span></a>&nbsp;';

        $out .= '<a href="' . $url_u . '" class="nonajax" title="Update" aria-label="Update" data-pjax="0" >'
                . '<span class="glyphicon glyphicon-pencil"></span></a>&nbsp;';

        $out .= '<a href="' . $url_d . '" class="nonajax" title="Delete" aria-label="Delete" data-pjax="0" >'
                . '<span class="glyphicon glyphicon-trash"></span></a>&nbsp;';

        return $out;
    }


    public function _url_action($action, $name, $depth) {
        $controller = Yii::$app->controller;
        $arrayParams = ['category' => $name, 'depth' => $depth];

        $params = array_merge(["{$controller->id}/{$action}"], $arrayParams);

        $url = Yii::$app->urlManager->createUrl($params);

        return $url;
    }
    
     public function  url_action2($id, $action) {
        $controller = Yii::$app->controller;
        $arrayParams = ['id' => $id];

        $params = array_merge(["nested2/{$action}"], $arrayParams);

        $url = Yii::$app->urlManager->createUrl($params);

        return $url;
    }

    public function TreeView($selectID = 0) {
        $model = $this->loadModel();
        $arr = $this->getDataID($model);

        return $this->TreeRecursive($this->TreeMergeArray($arr, $selectID), 0, 0);
    }

}
