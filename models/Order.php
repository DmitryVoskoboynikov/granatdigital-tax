<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Json;
use yii\web\ForbiddenHttpException;

/**
 * @property integer $id
 * @property integer $owner_id
 * @property integer $city
 * @property integer $client_id
 * @property string $order_start
 * @property integer $car_class
 * @property string $comment
 * @property integer $status_id
 * @property integer $car_id
 * @property string $distance
 *
 * @property User $owner
 * @property Client $client
 * @property Car $car
 * @property OrderHistory[] $orderHistories
 * @property OrderMessage[] $orderMessages
 *
 * @property Option[] $options
 * @property Address[] $addresses
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class Order extends DtoModel implements HasDto
{
    const STATUS_NEW = 1; //при создании заказа
    const STATUS_FOR_SALE = 2; //для выставления на биржу
    const STATUS_READY = 3; //при покупки заказа, готов к обработке и назначению машины
    const STATUS_WAIT_DRIVER = 4; // после назначения водителя, до момента как водитель доедет
    const STATUS_WAIT_CLIENT = 5; //после того как водитель приехал на место, ожидание клиента
    const STATUS_IN_PROGRESS = 6; //клиент в машине
    const STATUS_COMPLETE = 7; //заказ успешно завершен
    const STATUS_FAIL = 8; //заказ сорван по причине исполнителя
    const STATUS_CANCEL_BY_CLIENT = 9; //заказ отменён клиентом
    const STATUS_DELETE = 10; //заказ удалён

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_id', 'city', 'order_start'], 'required'],
            [['owner_id', 'city', 'client_id', 'car_class', 'status_id', 'car_id'], 'integer'],
            [['order_start'], 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],

            [['comment'], 'string', 'max' => 45],
            [['distance'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'city' => Yii::t('app', 'City'),
            'client_id' => Yii::t('app', 'Client ID'),
            'order_start' => Yii::t('app', 'Order Start'),
            'car_class' => Yii::t('app', 'Car Class'),
            'comment' => Yii::t('app', 'Comment'),
            'status_id' => Yii::t('app', 'Status ID'),
            'car_id' => Yii::t('app', 'Car ID'),
            'distance' => Yii::t('app', 'Distance'),
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
     * @return ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrderHistories()
    {
        return $this->hasMany(OrderHistory::className(), ['order_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrderMessages()
    {
        return $this->hasMany(OrderMessage::className(), ['order_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Option::className(), ['id' => 'option_id'])
            ->viaTable('order_option', ['order_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['id' => 'address_id'])
            ->viaTable('order_to_address', ['order_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }
    
    /**
     * @inheritdoc
     * @return OrderQuery
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function markAsDeleted()
    {
        if ($this->status_id !== self::STATUS_NEW) {
            throw new ForbiddenHttpException();
        }

        $this->status_id = self::STATUS_DELETE;
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function transitionToReady()
    {
        if ($this->status_id !== self::STATUS_NEW &&
            $this->status_id !== self::STATUS_FOR_SALE &&
            $this->status_id !== self::STATUS_WAIT_DRIVER
        ) {
            throw new ForbiddenHttpException();
        }

        $this->status_id = self::STATUS_READY;
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function transitionToForSale()
    {
        if ($this->status_id !== self::STATUS_READY) {
            throw new ForbiddenHttpException();
        }

        $this->status_id = self::STATUS_FOR_SALE;
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function transitionToWaitDriver()
    {
        if ($this->status_id !== self::STATUS_READY &&
            $this->status_id !== self::STATUS_WAIT_CLIENT
        ) {
            throw new ForbiddenHttpException();
        }

        $this->status_id = self::STATUS_WAIT_DRIVER;
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function transitionToWaitClient()
    {
        if ($this->status_id !== self::STATUS_WAIT_DRIVER) {
            throw new ForbiddenHttpException();
        }

        $this->status_id = self::STATUS_WAIT_CLIENT;
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function transitionToInProgress()
    {
        if ($this->status_id !== self::STATUS_WAIT_CLIENT) {
            throw new ForbiddenHttpException();
        }

        $this->status_id = self::STATUS_IN_PROGRESS;
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function transitionToComplete()
    {
        if ($this->status_id !== self::STATUS_IN_PROGRESS) {
            throw new ForbiddenHttpException();
        }

        $this->status_id = self::STATUS_COMPLETE;
    }

    /**
     * @throws ForbiddenHttpException
     */
    public function transitionToCancelByClient()
    {
        if ($this->status_id !== self::STATUS_IN_PROGRESS &&
            $this->status_id !== self::STATUS_READY &&
            $this->status_id !== self::STATUS_WAIT_DRIVER &&
            $this->status_id !== self::STATUS_WAIT_CLIENT
        ) {
            throw new ForbiddenHttpException();
        }

        $this->status_id = self::STATUS_CANCEL_BY_CLIENT;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $orderHistory = new OrderHistory();
        $orderHistory->order_id = $this->id;
        $orderHistory->status = $this->status_id;
        $orderHistory->created_at = date('Y-m-d H:i:s');

        if (isset($changedAttributes['status_id'])) {
            $orderHistory->prev_status = $changedAttributes['status_id'];
        }

        $orderHistory->owner_id = 1; //todo fix it

        if ($insert) {
            $message =  Yii::t('app', 'order_history_message_create');
        } else {
            $message =  Yii::t('app', 'order_history_message_update');
        }

        $orderHistory->description = $message;
        $orderHistory->save();

        \Yii::info(['orderData' => Json::encode($this), 'changedAttributes' => Json::encode($changedAttributes)], 'order');

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(array(
            'id',
            'owner',
            'client',
            'order_start',
            'car_class',
            'status',
            'comment',
            'options',
            'car',
            'addresses',
            'distance',
            )
        );
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        $statuses = $this->getStatuses();

        return $statuses[$this->status_id];
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        return  array(
            self::STATUS_NEW => Yii::t('app', 'order_status_new'),
            self::STATUS_DELETE => Yii::t('app', 'order_status_delete'),
            self::STATUS_READY => Yii::t('app', 'order_status_ready'),
            self::STATUS_FOR_SALE => Yii::t('app', 'order_status_for_sale'),
            self::STATUS_WAIT_DRIVER => Yii::t('app', 'order_status_wait_driver'),
            self::STATUS_WAIT_CLIENT => Yii::t('app', 'order_status_wait_client'),
            self::STATUS_IN_PROGRESS => Yii::t('app', 'order_status_in_progress'),
            self::STATUS_COMPLETE => Yii::t('app', 'order_status_complete'),
            self::STATUS_FAIL => Yii::t('app', 'order_status_fail'),
            self::STATUS_CANCEL_BY_CLIENT => Yii::t('app', 'order_status_cancel_by_client'),
        );
    }
}
