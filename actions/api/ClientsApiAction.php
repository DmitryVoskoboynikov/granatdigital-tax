<?php

namespace app\actions\api;

use app\models\Client;
use yii\helpers\Json;
use yii\web\ConflictHttpException;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class ClientsApiAction extends AbstractApiAction
{
    /**
     * @return string
     */
    protected function get()
    {
        $params = $this->getApiRequest()->getParams();

        if (isset($params['id'])) {
            $client = $this->getClientById($params['id']);
            $response = $client->getDto();
        } else {
            $response = Client::find()->dtoCollection();
        }

        return Json::encode($response);
    }

    /**
     * @return string
     */
    protected function create()
    {
        $data = $this->getApiRequest()->getBody();

        $this->handlePhone($data['phone']);

        $client = new Client();
        $client->name = $data['name'];
        $client->phone = $data['phone'];

        $client->save();

        return Json::encode($client->getDto());
    }

    /**
     * @return string
     * @throws ConflictHttpException
     * @throws NotFoundHttpException
     */
    protected function update()
    {
        $data = $this->getApiRequest()->getBody();
        $params = $this->getApiRequest()->getParams();
        $id = $params['id'];

        $client = $this->getClientById($id);

        if (isset($data['name'])) {
            $client->name = $data['name'];
        }

        if (isset($data['phone'])) {
            $this->handlePhone($data['phone']);
            $client->phone = $data['phone'];
        }

        $client->save();

        return Json::encode($client->getDto());
    }

    /**
     * @return string
     */
    protected function delete()
    {
//        $params = $this->getApiRequest()->getParams();
//        $id = $params['id'];
//
//        $client = $this->getClientById($id);
//        $client->markAsDeleted();
//        $client->save();
    }


    /**
     * @param int $id
     * @return Client
     * @throws NotFoundHttpException
     */
    private function getClientById($id)
    {
        $client = Client::find()->where('id = :id', ['id' => $id])->one();

        if (!$client) {
            throw new NotFoundHttpException();
        }

        return $client;

    }

    /**
     * @param $phone
     * @throws ConflictHttpException
     * todo move to client phone validator
     */
    private function handlePhone($phone)
    {
        if (null !== Client::find()->byPhone($phone)->one()) {
            throw new ConflictHttpException('phone already use');
        }
    }
}
