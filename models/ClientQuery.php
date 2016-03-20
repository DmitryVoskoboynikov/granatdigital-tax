<?php

namespace app\models;

use app\core\AbstractQuery;

/**
 * @see Client
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class ClientQuery extends AbstractQuery
{
    /**
     * @param $phone
     * @return $this
     */
    public function byPhone($phone)
    {
        return $this->andWhere(array('phone' => $phone));
    }
}