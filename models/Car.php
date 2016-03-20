<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;
use yii\db\ActiveQuery;

/**
 * @property string $brand
 * @property string $model
 * @property integer $color_id
 * @property string $number
 * @property integer $class
 * @property integer $id
 * @property integer $owner_id
 *
 * @property User $owner
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class Car extends DtoModel implements HasDto
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand', 'model', 'color_id', 'number'], 'required'],
            [['color_id', 'class', 'owner_id'], 'integer'],
            [['brand'], 'string', 'max' => 45],
            [['model'], 'string', 'max' => 100],
            [['number'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand' => Yii::t('app', 'Brand'),
            'model' => Yii::t('app', 'Model'),
            'color_id' => Yii::t('app', 'Color ID'),
            'number' => Yii::t('app', 'Number'),
            'class' => Yii::t('app', 'Class'),
            'id' => Yii::t('app', 'ID'),
            'owner_id' => Yii::t('app', 'Owner ID'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @inheritdoc
     * @return CarQuery
     */
    public static function find()
    {
        return new CarQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(array(
            'id',
            'number',
            'class',
            'brand',
            'model',
            'color_id'
        ));
    }
}
