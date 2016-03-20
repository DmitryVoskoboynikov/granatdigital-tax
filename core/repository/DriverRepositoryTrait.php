<?php

namespace app\core\repository;

use app\models\Car;
use app\models\Group;
use app\models\User;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
trait DriverRepositoryTrait
{
    /**
     * @param int $id
     * @return User
     * @throws NotFoundHttpException
     */
    private function getDriverById($id)
    {
        $user = User::find()->where('id = :id')->andWhere('group_id = :driver')
            ->addParams(['id' => $id, 'driver' => Group::DRIVER])->one();

        if (!$user) {
            throw new NotFoundHttpException();
        }

        return $user;

    }

    /**
     * @param int $carId
     * @param int $driverId
     * @return Car|array|null
     * @throws NotFoundHttpException
     */
    private function getCar($carId, $driverId)
    {
        $car = Car::find()
            ->where('id = :id')
            ->andWhere('owner_id = :driverId',
                [':id' => $carId, ':driverId' => $driverId])
            ->one();

        if (!$car) {
            throw new NotFoundHttpException();
        }

        return $car;
    }
}
