<?php

namespace app\actions\api;

use app\core\ApiRequest;
use app\core\AuthenticationHandler;
use yii\helpers\Json;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class ServerApiKeyApiAction extends AbstractApiAction
{
    /**
     * @return string
     */
    protected function get()
    {
        $apiRequest = new ApiRequest();
        $handler = new AuthenticationHandler();
        $handler->handle($apiRequest);

        return Json::encode(true);
    }

    /**
     * @return string
     */
    protected function create()
    {
        // TODO: Implement create() method.
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