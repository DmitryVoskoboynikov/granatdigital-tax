<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;

/**
 * @property integer $id
 * @property string $description
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class Option extends DtoModel implements HasDto
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['description'], 'string', 'max' => 45],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return OptionQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])
            ->viaTable('order_option', ['option_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return OptionQuery
     */
    public static function find()
    {
        return new OptionQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(array(
            'id',
            'description'
        ));
    }
}
