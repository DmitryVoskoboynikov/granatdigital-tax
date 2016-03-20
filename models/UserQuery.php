<?php

namespace app\models;

use app\core\AbstractQuery;
use app\core\DtoModel;

/**
 * @see User
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class UserQuery extends AbstractQuery
{
    /**
     * @inheritdoc
     * @return User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @inheritdoc
     * @return DtoModel[]|array
     */
    public function driverDtoCollection($db = null)
    {
        $models = $this->where('group_id = :group', ['group' => Group::DRIVER])->all($db);
        $modelsDto = array();

        foreach ($models as $model) {
            /**@var DtoModel $model */
            $modelsDto[] = $model->getDriverDto();
        }

        return $modelsDto;
    }

    /**
     * @inheritdoc
     * @return DtoModel[]|array
     */
    public function dispatcherDtoCollection($db = null)
    {
        $models = $this->where('group_id = :group', ['group' => Group::DISPATCHER])->all($db);
        $modelsDto = array();

        foreach ($models as $model) {
            /**@var DtoModel $model */
            $modelsDto[] = $model->getDto();
        }

        return $modelsDto;
    }

    /**
     * @param string $login
     * @return UserQuery
     */
    public function byLogin($login)
    {
        return $this->andWhere(array('login' => $login));
    }

    /**
     * @param int $phone
     * @return $this
     */
    public function byPhone($phone)
    {
        return $this->andWhere(array('phone' => $phone));
    }
}