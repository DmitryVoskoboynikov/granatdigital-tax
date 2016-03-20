<?php

namespace app\core;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
trait DtoCollectionTrait
{
    /**
     * @inheritdoc
     * @return DtoModel[]|array
     */
    public function dtoCollection($db = null)
    {
        $models = $this->all($db);
        $modelsDto = array();

        foreach ($models as $model) {
            /**@var DtoModel $model */
            $modelsDto[] = $model->getDto();
        }

        return $modelsDto;
    }
}
