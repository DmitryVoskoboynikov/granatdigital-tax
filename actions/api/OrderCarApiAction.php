<?php

namespace app\actions\api;

use app\core\repository\CarRepositoryTrait;
use app\core\repository\OrderRepositoryTrait;
use yii\helpers\Json;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OrderCarApiAction extends AbstractApiAction
{
    use OrderRepositoryTrait;
    use CarRepositoryTrait;

    /**
     * @return string
     */
    protected function create()
    {
        $data = $this->getApiRequest()->getBody();
        $id = $this->getApiRequest()->getParams()['orderId'];

        $order = $this->getOrderById($id);
        $car = $this->getCarById($data['id']);

        $order->car_id = $car->id;
        $order->transitionToWaitDriver();

        $order->save();

        return Json::encode($order->getDto());
    }

    /**
     * @return string
     */
    protected function update()
    {
        $data = $this->getApiRequest()->getBody();
        $id = $this->getApiRequest()->getParams()['orderId'];

        $order = $this->getOrderById($id);
        $car = $this->getCarById($data['id']);

        $order->car_id = $car->id;
        $order->transitionToReady(); //для нотификаций
        $order->transitionToWaitDriver(); //для нотификаций

        $order->save();

        return Json::encode($order->getDto());
    }

    /**
     * @return string
     */
    protected function delete()
    {
        $id = $this->getApiRequest()->getParams()['orderId'];
        $order = $this->getOrderById($id);

        $order->car_id = null;
        $order->transitionToReady();

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
}
