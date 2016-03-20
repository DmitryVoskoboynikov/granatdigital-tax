<?php

namespace app\actions\api;

use app\models\OrderMessage;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OrderMessageApiAction extends AbstractApiAction
{
    /**
     * @return string
     */
    protected function get()
    {
        $params = $this->getApiRequest()->getParams();
        $orderId = $params['orderId'];

        $orders = OrderMessage::find()->byOrderId($orderId)->dtoCollection();

        return Json::encode($orders);
    }

    /**
     * @return string
     */
    protected function create()
    {
        $data = $this->getApiRequest()->getBody();

        $orderMessage = new OrderMessage();
        $orderMessage->owner_id = 1; //todo create handler
        $orderMessage->order_id = $this->getApiRequest()->getParams()['orderId'];
        $orderMessage->message = $data['message'];
        $orderMessage->created_at = date('Y-m-d H:i:s');
        $orderMessage->status_id = OrderMessage::STATUS_NEW;

        $orderMessage->save();

        return Json::encode($orderMessage->getDto());
    }

    protected function update()
    {
        return false;
    }

    protected function delete()
    {
        $params = $this->getApiRequest()->getParams();
        $id = $params['id'];

        $orderMessage = $this->getMessageById($id);
        $orderMessage->markAsDeleted();
        $orderMessage->save();
    }

    /**
     * @param int $id
     * @return OrderMessage
     * @throws NotFoundHttpException
     */
    private function getMessageById($id)
    {
        $orderMessage = OrderMessage::find()->where('id = :id', ['id' => $id])->one();

        if (!$orderMessage) {
            throw new NotFoundHttpException();
        }

        return $orderMessage;
    }
}