<?php

namespace app\models;

use yii\base\Model;
use Yii;
use app\models\User;
use app\models\Company;

/**
 * Manager form
 *
 * @author Voskoboynikov Dmitry <voskoboynikov@granat-digital.ru>
 */
class ManagerForm extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['email', 'email', 'message' => Yii::t('app/forms', 'error_email')],
            ['email', 'string', 'max' => 255, 'tooShort' => Yii::t('app/forms', 'error_too_short')],
            [
                'email',
                'unique',
                'targetClass' => 'app\models\User',
                'targetAttribute' => 'email',
                'message' => Yii::t('app/forms', 'error_unique')
            ],
            ['login', 'filter', 'filter' => 'trim'],
            ['login', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['login', 'string', 'max' => 255, 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['login', 'match', 'pattern' => '/^[a-zA-Z\s\-_0-9]+$/u', 'message' => Yii::t('app/forms', 'error_login')],

            ['company_id', 'required', 'message' => Yii::t('app/forms', 'error_required')],

            ['first_name', 'filter', 'filter' => 'trim'],
            ['first_name', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['first_name', 'string', 'min' => 2, 'max' => 255, 'tooShort' => Yii::t('app/admin', 'error_too_short'), 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['first_name', 'match', 'pattern' => '/^[а-яА-Я\p{Cyrillic}]+$/u', 'message' => Yii::t('app/forms', 'error_alphabetic')],
            ['second_name', 'filter', 'filter' => 'trim'],
            ['second_name', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['second_name', 'string', 'min' => 2, 'max' => 255, 'tooShort' => Yii::t('app/admin', 'error_too_short'), 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['second_name', 'match', 'pattern' => '/^[а-яА-Я\p{Cyrillic}]+$/u', 'message' => Yii::t('app/forms', 'error_alphabetic')],
            ['last_name', 'filter', 'filter' => 'trim'],
            ['last_name', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['last_name', 'string', 'min' => 2, 'max' => 255, 'tooShort' => Yii::t('app/admin', 'error_too_short'), 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['last_name', 'match', 'pattern' => '/^[а-яА-Я\p{Cyrillic}]+$/u', 'message' => Yii::t('app/forms', 'error_alphabetic')],

            ['phone', 'filter', 'filter' => 'trim'],
            ['phone', 'required', 'message' => Yii::t('app/forms', 'error_required')],

            ['birthday', 'filter', 'filter' => 'trim'],
            ['birthday', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['birthday', 'date', 'format' => 'yyyy-MM-dd', 'message' => Yii::t('app/forms', 'error_date')],
        ];
    }

    /**
     * Return key-value array company_id => Company Title
     *
     * @return array
     */
    public function getCompanyList()
    {
        $companies = Company::find()->all();

        $list = array();
        foreach ($companies as $company) {
            $list[$company->id] = $company->title;
        }

        return $list;
    }

    /**
     * Clean up phone.
     *
     * @return integer|null
     */
    protected function formatPhone($phone)
    {
        return intval(preg_replace('/\D/', '', $phone));
    }
}
