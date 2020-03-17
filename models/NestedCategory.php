<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nested_category".
 *
 * @property int $category_id
 * @property string $name
 * @property int $lft
 * @property int $rgt
 */
class NestedCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nested_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lft', 'rgt'], 'required'],
            [['lft', 'rgt'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'name' => 'Name',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
        ];
    }
}
