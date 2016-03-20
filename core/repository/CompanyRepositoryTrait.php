<?php

namespace app\core\repository;

use app\models\Company;
use yii\web\NotFoundHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
trait CompanyRepositoryTrait
{
    /**
     * @param int $id
     * @return Company
     * @throws NotFoundHttpException
     */
    public function getCompanyById($id)
    {
        $company = Company::find()->where('id = :id', ['id' => $id])->one();

        if (!$company) {
            throw new NotFoundHttpException();
        }

        return $company;
    }
}
