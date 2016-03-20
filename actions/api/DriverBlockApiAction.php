<?php

namespace app\actions\api;

use app\core\repository\DriverRepositoryTrait;
use yii\helpers\Json;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class DriverBlockApiAction extends AbstractApiAction
{
    use DriverRepositoryTrait;

    /**
     * @return string
     */
    protected function create()
    {
        $params = $this->getApiRequest()->getParams();
        $data = $this->getApiRequest()->getBody();
        $driver = $this->getDriverById($params['id']);

        if ($data['action'] === 'enable') {
            $driver->block();
        } elseif ($data['action'] === 'disable') {
            $driver->unBlock();
        }

        $driver->save();

        return Json::encode($driver->getDriverDto());
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
}