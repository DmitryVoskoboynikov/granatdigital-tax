<?php

namespace app\models;

use app\core\DtoCollectionTrait;
use yii\db\ActiveQuery;

/**
 * @see Car
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class CarQuery extends ActiveQuery
{
    use DtoCollectionTrait;

    /**
     * @inheritdoc
     * @return Car[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Car|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}