<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class Group extends ActiveRecord
{
    const DRIVER = 5;
    const DISPATCHER = 6;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return GroupQuery
     */
    public static function find()
    {
        return new GroupQuery(get_called_class());
    }
}
