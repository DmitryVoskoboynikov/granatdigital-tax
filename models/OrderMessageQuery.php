<?php

namespace app\models;

use app\core\DtoCollectionTrait;

/**
 * @see OrderMessage
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OrderMessageQuery extends \yii\db\ActiveQuery
{
    use DtoCollectionTrait;

    /**
     * @inheritdoc
     * @return OrderMessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderMessage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $orderId
     * @return OrderMessageQuery
     */
    public function byOrderId($orderId)
    {
        return $this->andWhere(array('order_id' => $orderId));
    }
}