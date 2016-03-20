<?php

namespace app\actions\api;

use app\core\repository\CompanyRepositoryTrait;
use app\models\Company;
use yii\helpers\Json;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class CompaniesApiAction extends AbstractApiAction
{
    use CompanyRepositoryTrait;

    /**
     * @return string
     */
    protected function get()
    {
        $params = $this->getApiRequest()->getParams();

        if (isset($params['id'])) {
            $company = $this->getCompanyById($params['id']);
            $response = $company->getDto();
        } else {
            $response = Company::find()->dtoCollection();
        }

        return Json::encode($response);
    }

    /**
     * @return string
     */
    protected function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * @return string
     */
    protected function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * @return string
     */
    protected function delete()
    {
        // TODO: Implement delete() method.
    }
}
