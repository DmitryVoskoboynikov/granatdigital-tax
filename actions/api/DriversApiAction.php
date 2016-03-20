<?php

namespace app\actions\api;

use app\core\repository\DriverRepositoryTrait;
use app\models\Car;
use app\models\Group;
use app\models\User;
use yii\helpers\Json;
use yii\web\ConflictHttpException;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class DriversApiAction extends AbstractApiAction
{
    use DriverRepositoryTrait;

    /**
     * @return string
     */
    protected function get()
    {
        $params = $this->getApiRequest()->getParams();

        if (isset($params['id'])) {
            $driver = $this->getDriverById($params['id']);
            $response = $driver->getDriverDto();
        } else {
            $response = User::find()->driverDtoCollection();
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

        $driver = new User();
        //$driver->company_id = \Yii::$app->user->getCompanyId();
        $driver->group_id = Group::DRIVER;

        if (isset($data['first_name'])) {
            $driver->first_name = $data['first_name'];
        }

        if (isset($data['second_name'])) {
            $driver->second_name = $data['second_name'];
        }

        if (isset($data['last_name'])) {
            $driver->last_name = $data['last_name'];
        }

        $driver->phone = $data['phone'];
        $driver->password = md5(time());
        $driver->save();

        if (isset($data['cars']) && is_array($data['cars'])) {
            foreach($data['cars'] as $carData) {
                $car = new Car();
                $car->brand = $carData['brand'];
                $car->class = $carData['class'];
                $car->color_id = $carData['color_id'];
                $car->number = $carData['number'];
                $car->model = $carData['model'];
                $car->owner_id = $driver->id;

                $driver->link('cars', $car);
            }
        }

        return Json::encode($driver->getDriverDto());
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

        $this->handlePhone($data['phone']);

        $driver = $this->getDriverById($id);

        if (isset($data['first_name'])) {
            $driver->first_name = $data['first_name'];
        }

        if (isset($data['second_name'])) {
            $driver->second_name = $data['second_name'];
        }

        if (isset($data['last_name'])) {
            $driver->last_name = $data['last_name'];
        }

        if (isset($data['phone'])) {
            $driver->phone = $data['phone'];
        }

        $driver->save();

        return Json::encode($driver->getDriverDto());
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
     * @param $phone
     * @throws ConflictHttpException
     * todo move to client phone validator
     */
    private function handlePhone($phone)
    {
        if (null !== User::find()->byPhone($phone)->one()) {
            throw new ConflictHttpException('phone already use');
        }
    }
}
