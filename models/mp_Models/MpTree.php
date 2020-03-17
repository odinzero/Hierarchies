<?php

namespace app\models\mp_Models;

use Yii;

/**
 * This is the model class for table "mp_tree".
 *
 * @property string $id
 * @property string $name
 * @property string $path
 * @property int $level
 */
class MpTree extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_tree';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path', 'level'], 'required'],
            [['level'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['path'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'path' => 'Path',
            'level' => 'Level',
        ];
    }
}
