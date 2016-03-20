<?php

namespace app\models;

/**
 * @see CompanyChiefQuery
 *
 * @author Voskoboynikov Dmitry <voskoboynikov@granat-digital.ru>
 */
class CompanyChiefQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return CompanyChief[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyChief|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}