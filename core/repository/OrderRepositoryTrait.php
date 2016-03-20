<?php

namespace app\core\repository;

use app\models\Order;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
trait OrderRepositoryTrait
{
    /**
     * @param int $id
     * @return Order
     * @throws NotFoundHttpException
     */
    private function getOrderById($id)
    {
        $order = Order::find()->where('id = :id', ['id' => $id])->one();

        if (!$order) {
            throw new NotFoundHttpException();
        }

        return $order;
    }
}
