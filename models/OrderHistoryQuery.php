<?php

namespace app\models;

use app\core\DtoCollectionTrait;
use yii\db\ActiveQuery;

/**
 * @see OrderHistory
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OrderHistoryQuery extends ActiveQuery
{
    use DtoCollectionTrait;

    /**
     * @inheritdoc
     * @return OrderHistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderHistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}