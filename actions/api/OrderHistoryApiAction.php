<?php

namespace app\actions\api;

use app\models\OrderHistory;
use yii\helpers\Json;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OrderHistoryApiAction extends AbstractApiAction
{
    protected function get()
    {
        $orders = OrderHistory::find()->where(
            'order_id = :order_id',
            ['order_id' => $this->getApiRequest()->getParams()['id']]
        )->with(['owner'])->dtoCollection();;

        return Json::encode($orders);
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
