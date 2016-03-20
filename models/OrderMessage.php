<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;

/**
 * This is the model class for table "order_message".
 *
 * @property integer $owner_id
 * @property string $message
 * @property integer $id
 * @property integer $order_id
 * @property integer $status_id
 * @property string $created_at
 *
 * @property Order $order
 * @property User $owner
 */
class OrderMessage extends DtoModel implements HasDto
{
    const STATUS_NEW = 1;
    const STATUS_DELETE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_id', 'order_id'], 'required'],
            [['owner_id', 'order_id', 'status_id'], 'integer'],
            [['created_at'], 'safe'],
            [['message'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'owner_id' => Yii::t('app', 'Owner ID'),
            'message' => Yii::t('app', 'Message'),
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @inheritdoc
     * @return OrderMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderMessageQuery(get_called_class());
    }


    public function markAsDeleted()
    {
        $this->status_id = self::STATUS_DELETE;
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(array(
            'id',
            'owner',
            'status',
            'created_at',
        ));
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        $statuses = array(
            self::STATUS_NEW => 'новый',
            self::STATUS_DELETE => 'удалён'
        );

        return $statuses[$this->status_id];
    }
}
