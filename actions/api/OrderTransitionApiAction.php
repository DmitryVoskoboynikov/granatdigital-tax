<?php

namespace app\actions\api;

use app\models\Order;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OrderTransitionApiAction extends AbstractApiAction
{
    /**
     * @return string
     */
    protected function create()
    {
        $order = $this->getOrderById($this->getApiRequest()->getParams()['orderId']);

        $data = $this->getApiRequest()->getBody();
        switch ($data['action']) {
            case 'ready':
                $order->transitionToReady();
                break;
            case 'for_sale':
                $order->transitionToForSale();
                break;
            case 'wait_driver':
                $order->transitionToWaitDriver();
                break;
            case 'wait_client':
                $order->transitionToWaitClient();
                break;
            case 'in_progress':
                $order->transitionToInProgress();
                break;
            case 'complete':
                $order->transitionToComplete();
                break;
            case 'cancel_by_client':
                $order->transitionToCancelByClient();
                break;
        }

        $order->save();

        return Json::encode($order->getDto());
    }

    /**
     * @return string
     */
    protected function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @return string
     */
    protected function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * @return string
     */
    protected function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param int $id
     * @return Order
     * @throws NotFoundHttpException
     */
    private function getOrderById($id)
    {
        $order = Order::find('id = :id', ['id' => $id])->one();

        if (!$order) {
            throw new NotFoundHttpException();
        }

        return $order;
    }
}