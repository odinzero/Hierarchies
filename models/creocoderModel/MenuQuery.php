<?php

namespace app\models\creocoderModel;

use creocoder\nestedsets\NestedSetsQueryBehavior;


// https://github.com/creocoder/yii2-nested-sets
class MenuQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}
