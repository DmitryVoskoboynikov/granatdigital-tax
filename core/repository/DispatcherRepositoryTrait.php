<?php

namespace app\core\repository;

use app\models\Group;
use app\models\User;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
trait DispatcherRepositoryTrait
{
    /**
     * @param int $id
     * @return User
     * @throws NotFoundHttpException
     */
    private function getDispatcherById($id)
    {
        $client = User::find()->where('id = :id')->andWhere('group_id = :group')
            ->addParams(['id' => $id, 'group' => Group::DISPATCHER])->one();

        if (!$client) {
            throw new NotFoundHttpException();
        }

        return $client;
    }
}
