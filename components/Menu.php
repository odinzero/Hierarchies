<?php

namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use \yii\widgets\Menu as MenuYii;

class Menu extends MenuYii
{
    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => $item['label'],
                '{method}' => isset($item['method']) ? $item['method'] : 'get', //добавляем атрибут data-method
                '{display}' => isset($item['display']) ? $item['display'] : 'inline',
                '{id}' => $item['id'],
                '{position}' =>  isset($item['position']) ? $item['position'] : '0',
            ]);
        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{label}' => $item['label'],
        ]);
    }
    
     public function  url_action($id, $action) {
        $controller = Yii::$app->controller;
        $arrayParams = ['id' => $id];

        $params = array_merge(["nested2/{$action}"], $arrayParams);

        $url = Yii::$app->urlManager->createUrl($params);

        return $url;
    }
}
