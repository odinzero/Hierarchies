<?php

namespace app\models\binaryModels;

use Yii;

/**
 * This is the model class for table "binary_tree".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $user_id
 * @property int $level
 * @property string $path
 * @property int $position
 */
class BinaryTree extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'binary_tree';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'user_id', 'level', 'path', 'position'], 'required'],
            [['parent_id', 'user_id', 'level', 'position'], 'integer'],
            [['path'], 'string', 'max' => 12288],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'user_id' => 'User ID',
            'level' => 'Level',
            'path' => 'Path',
            'position' => 'Position',
        ];
    }
}
