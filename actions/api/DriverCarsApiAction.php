<?php
/**
 * Created by PhpStorm.
 * User: powar
 * Date: 15.11.15
 * Time: 14:23
 */

namespace app\actions\api;

use app\core\repository\DriverRepositoryTrait;
use app\models\Car;
use yii\helpers\Json;

class DriverCarsApiAction extends AbstractApiAction
{
    use DriverRepositoryTrait;

    /**
     * @return string
     */
    protected function get()
    {
        $params = $this->getApiRequest()->getParams();
        $driverId = $params['driverId'];

        if (isset($params['id'])) {
            $car = $this->getCar($params['id'], $driverId);
            $response = $car->getDto();
        } else {
            $response = Car::find()->where(
                    'owner_id = :driverId', ['driverId' => $driverId])->dtoCollection();
        }

        return Json::encode($response);
    }

    /**
     * @return string
     */
    protected function create()
    {
        $params = $this->getApiRequest()->getParams();
        $data = $this->getApiRequest()->getBody();
        $driver = $this->getDriverById($params['driverId']);

        $car = new Car();
        $car->brand = $data['brand'];
        $car->model = $data['model'];
        $car->number = $data['number'];
        $car->color_id = $data['color_id'];
        $car->class = $data['class'];
        $car->save();

        $driver->link('cars', $car);

        return Json::encode($car->getDto());
    }

    /**
     * @return string
     */
    protected function update()
    {
        $params = $this->getApiRequest()->getParams();
        $data = $this->getApiRequest()->getBody();
        $id = $params['id'];
        $driverId = $params['driverId'];

        $car = $this->getCar($id, $driverId);

        if (isset($data['brand'])) {
            $car->brand = $data['brand'];
        }

        if (isset($data['model'])) {
            $car->model = $data['model'];
        }

        if (isset($data['number'])) {
            $car->number = $data['number'];
        }

        if (isset($data['color_id'])) {
            $car->color_id = $data['color_id'];
        }

        if (isset($data['class'])) {
            $car->class = $data['class'];
        }

        $car->save();

        return Json::encode($car->getDto());
    }

    /**
     * @return string
     */
    protected function delete()
    {
        $params = $this->getApiRequest()->getParams();
        $id = $params['id'];
        $driverId = $params['driverId'];

        $car = $this->getCar($id, $driverId);
        $car->markAsDeleted();
        $car->save();
    }
}
