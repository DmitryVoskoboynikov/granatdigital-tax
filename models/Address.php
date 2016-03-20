<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;
use yii\db\ActiveQuery;


/**
 * This is the model class for table "{{%address}}".
 *
 * @property integer $id
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 *
 * @property Order[] $orderToAddresses
 */
class Address extends DtoModel implements HasDto
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'string', 'max' => 500],
            [['longitude', 'latitude'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'address' => Yii::t('app', 'Address'),
            'latitude' => Yii::t('app', 'latitude'),
            'longitude' => Yii::t('app', 'longitude'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])
            ->viaTable('order_to_address', ['address_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AddressQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(array(
            'id',
            'address',
            'latitude',
            'longitude',
        ));
    }
}
