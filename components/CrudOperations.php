<?php

namespace app\components;

use Yii;
use yii\base\Component;

class CrudOperations  {
    
      public function  url_action($id, $action) {
        $controller = Yii::$app->controller;
        $arrayParams = ['id' => $id];

        $params = array_merge(["nested2/{$action}"], $arrayParams);

        $url = Yii::$app->urlManager->createUrl($params);

        return $url;
    }
    
}
