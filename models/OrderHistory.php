<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;
use yii\db\ActiveQuery;

/**
 * @property integer $order_id
 * @property string $created_at
 * @property integer $prev_status
 * @property integer $status
 * @property integer $owner_id
 * @property string $description
 *
 * @property Order $order
 * @property User $owner
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OrderHistory extends DtoModel implements HasDto
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'created_at'], 'required'],
            [['order_id', 'prev_status', 'status', 'owner_id'], 'integer'],
            [['created_at'], 'safe'],
            [['description'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'prev_status' => Yii::t('app', 'Prev Status'),
            'status' => Yii::t('app', 'Status'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
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
     * @return OrderHistoryQuery
     */
    public static function find()
    {
        return new OrderHistoryQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(array(
            'id',
            'created_at',
            'prev_status',
            'status',
            'owner',
            'description',
        ));
    }

    public function getStatus()
    {
        return $this->getOrder()->one()->getStatus();
    }
}
