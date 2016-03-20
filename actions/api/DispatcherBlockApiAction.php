<?php

namespace app\actions\api;
use yii\helpers\Json;
use app\core\repository\DispatcherRepositoryTrait;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class DispatcherBlockApiAction extends AbstractApiAction
{
    use DispatcherRepositoryTrait;

    /**
     * @return string
     */
    protected function create()
    {
        $params = $this->getApiRequest()->getParams();
        $data = $this->getApiRequest()->getBody();
        $driver = $this->getDispatcherById($params['id']);

        if ($data['action'] === 'enable') {
            $driver->block();
        } elseif ($data['action'] === 'disable') {
            $driver->unBlock();
        }

        $driver->save();

        return Json::encode($driver->getDto());
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
