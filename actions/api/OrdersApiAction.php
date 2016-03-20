<?php

namespace app\actions\api;

use app\core\repository\OrderRepositoryTrait;
use app\models\Address;
use app\models\Client;
use app\models\Option;
use app\models\Order;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OrdersApiAction extends AbstractApiAction
{
    use OrderRepositoryTrait;

    /**
     * @return string
     */
    protected function get()
    {
        $params = $this->getApiRequest()->getParams();

        if (isset($params['id'])) {
            $order = $this->getOrderById($params['id']);
            $response = $order->getDto();
        } else {
            $response = Order::searchByParams($params)->dtoCollection();
        }

        return Json::encode($response);
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    protected function create()
    {
        $data = $this->getApiRequest()->getBody();

        $client = $this->handleClient($data['client']);

        $order = new Order();
        $order->owner_id = 1; //todo create handler
        $order->city = $data['city'];
        $order->order_start = $data['order_start'];
        $order->car_class = $data['car_class'];
        $order->comment = $data['comment'];
        $order->client_id = $client->id;
        $order->status_id = Order::STATUS_NEW;

        $order->save();

        if (isset($data['options']) && is_array($data['options'])) {
            $this->handleOptions($order, $data['options']);
        }

        if (isset($data['addresses']) && is_array($data['addresses'])) {
            $this->handleAddresses($order, $data['addresses']);
        }

        return Json::encode($order->getDto());
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    protected function update()
    {
        $data = $this->getApiRequest()->getBody();
        $params = $this->getApiRequest()->getParams();
        $id = $params['id'];

        $order = $this->getOrderById($id);

        if (isset($data['client'])) {
            $client = $this->handleClient($data['client']);
            $order->client_id = $client->id;
        }

        if (isset($data['city'])) {
            $order->city = $data['city'];
        }

        if (isset($data['order_start'])) {
            $order->order_start = $data['order_start'];
        }

        if (isset($data['car_class'])) {
            $order->car_class = $data['car_class'];
        }

        if (isset($data['comment'])) {
            $order->comment = $data['comment'];
        }

        if (isset($data['options']) && is_array($data['options'])) {
            $this->handleOptions($order, $data['options'], true);
        }

        if (isset($data['addresses']) && is_array($data['addresses'])) {
            $this->handleAddresses($order, $data['addresses'], true);
        }

        $order->save();

        return Json::encode($order->getDto());
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function delete()
    {
        $params = $this->getApiRequest()->getParams();
        $id = $params['id'];

        $order = $this->getOrderById($id);
        $order->markAsDeleted();
        $order->save();
    }

    /**
     * @param array $data
     * @return Client
     */
    private function handleClient(array $data)
    {
        $client = Client::find()->where('phone = :phone', ['phone' => $data['phone']])->one();

        if (!$client) {
            $client = new Client();
            $client->phone = $data['phone'];
            if (isset($data['name'])) {
                $client->name = $data['name'];
            }

            $client->save();
        }

        if (!$client->name && isset($data['name'])) {
            $client->name = $data['name'];
            $client->save();
        }

        return $client;
    }

    /**
     * @param Order $order
     * @param array $optionsData
     * @param bool $removeOldRelation
     * @throws NotFoundHttpException
     */
    private function handleOptions(Order $order, array $optionsData, $removeOldRelation = false)
    {
        if ($removeOldRelation) {
            $order->unlinkAll('options', true);
        }

        foreach ($optionsData as $optionData) {
            $option = Option::find()->where('id = :id', ['id' => $optionData['id']])->one();

            if (!$option) {
                throw new NotFoundHttpException("option id# {$optionData['id']} not found");
            }

            $order->link('options', $option);
        }
    }

    /**
     * @param Order $order
     * @param array $addressesData
     * @param bool $removeOldRelation
     * @throws NotFoundHttpException
     */
    private function handleAddresses(Order $order, array $addressesData, $removeOldRelation = false)
    {
        if ($removeOldRelation) {
            $order->unlinkAll('addresses', true);
        }

        foreach ($addressesData as $addressData) {
            if (isset($addressData['id'])) {
                $address = Address::find()->where('id = :id', ['id' => $addressData['id']])->one();
            } else {
                $address = Address::find()->where('address = :address', ['address' => $addressData['address']])->one();
            }

            if (!$address) {
                $address = new Address();
                $address->setAttributes($addressData);
                $address->save();
            }

            $order->link('addresses', $address);
        }
    }
}
