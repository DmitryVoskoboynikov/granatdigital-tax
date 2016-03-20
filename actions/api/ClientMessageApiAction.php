<?php

namespace app\actions\api;

use app\models\ClientMessage;
use yii\helpers\Json;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class ClientMessageApiAction extends AbstractApiAction
{
    /**
     * @return string
     */
    protected function get()
    {
        $params = $this->getApiRequest()->getParams();
        $clientId = $params['clientId'];

        $orders = ClientMessage::find()->byClientId($clientId)->dtoCollection();

        return Json::encode($orders);
    }

    /**
     * @return string
     */
    protected function create()
    {
        $data = $this->getApiRequest()->getBody();
        $params = $this->getApiRequest()->getParams();
        $clientId = $params['clientId'];

        $message = new ClientMessage();
        $message->owner_id = 1; //todo create handler
        $message->message = $data['message'];
        $message->created_at = date('Y-m-d H:i:s');
        $message->type_id = $data['type_id'];
        $message->client_id = $clientId;

        $message->save();

        return Json::encode($message->getDto());
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
}