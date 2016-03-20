<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;
use yii\db\ActiveQuery;

/**
 * @property integer $id
 * @property string $phone
 * @property string $name
 * @property string $in_blacklist
 *
 * @property ClientMessage $clientMessage
 * @property Order[] $orders
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class Client extends DtoModel implements HasDto
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getClientMessage()
    {
        return $this->hasOne(ClientMessage::className(), ['client_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['client_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ClientQuery
     */
    public static function find()
    {
        return new ClientQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(array(
                'id',
                'name',
                'phone',
                'in_blacklist',
            )
        );
    }
}
