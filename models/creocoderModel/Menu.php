<?php

namespace app\models\creocoderModel;

use creocoder\nestedsets\NestedSetsBehavior;

// https://github.com/creocoder/yii2-nested-sets

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $tree
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $name
 */
class Menu extends \yii\db\ActiveRecord
{
     /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['tree','lft', 'rgt', 'depth', 'name'], 'required'],
            [['tree', 'lft', 'rgt', 'depth'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => 'Tree',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'name' => 'Name',
        ];
    }
    
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
//                 'leftAttribute' => 'lft',
//                 'rightAttribute' => 'rgt',
//                 'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}

