<?php

namespace app\core\repository;

use app\models\Car;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
trait CarRepositoryTrait
{
    public function getCarById($id)
    {
        $order = Car::find()->where('id = :id', ['id' => $id])->one();

        if (!$order) {
            throw new NotFoundHttpException();
        }

        return $order;
    }
}
