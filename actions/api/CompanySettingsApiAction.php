<?php

namespace app\actions\api;
use app\models\CompanySetting;
use app\core\repository\CompanyRepositoryTrait;
use yii\helpers\Json;
use yii\web\ConflictHttpException;
use yii\web\MethodNotAllowedHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class CompanySettingsApiAction extends AbstractApiAction
{
    use CompanyRepositoryTrait;

    /**
     * @return string
     */
    protected function get()
    {
        $companyId = $this->getApiRequest()->getParams()['id'];

        $settings = CompanySetting::find()->byCompanyId($companyId)->dtoCollection();

        return Json::encode($settings);
    }

    /**
     * @return string
     * @throws ConflictHttpException
     * @throws \yii\web\NotFoundHttpException
     */
    protected function create()
    {
        $data = $this->getApiRequest()->getBody();

        if (!$this->validateSettings($data)) {
            throw new ConflictHttpException();
        }

        $companyId = $this->getApiRequest()->getParams()['id'];
        $company = $this->getCompanyById($companyId);

        $settings = new CompanySetting();
        $settings->settings = serialize($data);

        $company->link('setting', $settings);

        return Json::encode($company->getDto());
    }

    /**
     * @return string
     */
    protected function update()
    {
        $data = $this->getApiRequest()->getBody();

        if (!$this->validateSettings($data)) {
            throw new ConflictHttpException();
        }

        $companyId = $this->getApiRequest()->getParams()['id'];
        $company = $this->getCompanyById($companyId);

        $companySettings = $company->getSetting()->one();
        $companySettingsArray = unserialize($companySettings->settings);

        foreach ($data as $key => $value) {
            $companySettingsArray[$key] = $value;
        }

        $companySettings->settings = serialize($companySettingsArray);
        $companySettings->save();

        return Json::encode($company->getDto());
    }

    /**
     * @throws MethodNotAllowedHttpException
     */
    protected function delete()
    {
        throw new MethodNotAllowedHttpException();
    }

    /**
     * @return bool
     */
    private function validateSettings()
    {
        return true; //todo implement this
    }
}
