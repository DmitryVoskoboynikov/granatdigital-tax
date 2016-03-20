<?php

namespace app\models;

/**
 * @see Group
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class GroupQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Group[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Group|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}