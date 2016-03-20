<?php

namespace app\models;

use app\core\AbstractQuery;

/**
 * @see Order
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class OrderQuery extends AbstractQuery
{
    /**
     * @return OrderQuery
     */
    public function filter()
    {
        if ($this->car_class) {
            $this->andWhere('car_class = :car_class', ['car_class' => $this->car_class]);
        }

        if ($this->status_id) {
            $this->andWhere('status_id = :status_id', ['status_id' => $this->status_id]);
        }

        if (is_array($this->options)) {
            $this->joinWith('options')->andWhere(['option_id' => implode(',', $this->options)]);
        }

        if ($this->company_id) {
            $this->joinWith('owner')->andWhere(['company_id' => $this->company_id]);
        }

        if ($this->owner_id) {
            $this->andWhere('owner_id = :owner_id', ['owner_id' => $this->owner_id]);
        }

        return $this;
    }
}
