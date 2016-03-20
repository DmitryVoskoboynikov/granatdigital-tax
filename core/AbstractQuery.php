<?php

namespace app\core;

use yii\db\ActiveQuery;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
abstract class AbstractQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return ActiveQuery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ActiveQuery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @inheritdoc
     * @return DtoModel[]|array
     */
    public function dtoCollection($db = null)
    {
        $models = $this->filter()->all($db);
        $modelsDto = array();

        foreach ($models as $model) {
            /**@var DtoModel $model */
            $modelsDto[] = $model->getDto();
        }

        return $modelsDto;
    }

    /**
     * @return AbstractQuery
     */
    public function filter()
    {
        return $this;
    }

    /**
     * @param array $params
     */
    public function fillSearchParams(array $params)
    {
        foreach ($params as $key => $param) {
            $this->$key = $param;
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
//        if (property_exists($this->modelClass, $name)) {
            $this->$name = $value;
//        }
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }

        return null;
    }
}
