<?php

namespace app\core;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
abstract class DtoModel extends ActiveRecord
{
    /**
     * @param array $names
     * @return array
     */
    public function getDtoAttributes(array $names)
    {
        $values = array();

        //todo need refactoring
        foreach ($names as $name) {
            $values[$name] = null;
            if ($this->$name instanceof HasDto) {
                $values[$name] = $this->$name->getDto();
            } elseif (is_array($this->$name)) {
                foreach ($this->$name as $element) {
                    $values[$name][] = $element->getDto();
                }
            } elseif (method_exists($this, 'get' . $name)) {
                $result = call_user_func(array($this, 'get' . $name));
                if ($result instanceof ActiveQuery) {
                    $result = $result->one();
                }
                $values[$name] = $result;
            } else {
                $values[$name] = $this->$name;
            }
        }

        return $values;
    }

    /**
     * @param array $params
     * @return AbstractQuery
     */
    public static function searchByParams(array $params)
    {
        $model = static::find();
        if ($model instanceof AbstractQuery) {
            $model->fillSearchParams($params);
        }

        return $model;
    }
}
