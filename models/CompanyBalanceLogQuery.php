<?php

namespace app\models;

/**
 * @see CompanyBalanceLog
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class CompanyBalanceLogQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return CompanyBalanceLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyBalanceLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}