<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * @see Option
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OptionQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return Option[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Option|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}