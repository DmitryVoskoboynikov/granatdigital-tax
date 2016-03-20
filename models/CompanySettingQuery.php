<?php

namespace app\models;

use app\core\AbstractQuery;

/**
 * @see CompanySetting
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class CompanySettingQuery extends AbstractQuery
{
    /**
     * @param int $companyId
     * @return OrderMessageQuery
     */
    public function byCompanyId($companyId)
    {
        return $this->andWhere(array('company_id' => $companyId));
    }
}