<?php

namespace app\core;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
interface HasDto {

    /**
     * @return array
     */
    public function getDto();
}