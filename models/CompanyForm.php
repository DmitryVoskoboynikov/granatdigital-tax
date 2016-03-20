<?php

namespace app\models;

use yii\base\Model;
use Yii;
use app\models\Company;
use app\models\CompanyChief;
use app\models\User;

class CompanyForm extends Model
{
    /** @const email pattern */
    CONST EMAIL_PATTERN = '/[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]/';

    /** @var email/login */
    public $email_login;
    /** @var password */
    public $password;

    /** @var title */
    public $title;
    /** @var name */
    public $name;

    /** @var dispatcher_phone */
    public $dispatcher_phone;
    /** @var physical_address */
    public $physical_address;
    /** @var legal_address */
    public $legal_address;

    /** @var inn */
    public $inn;
    /** @var kpp */
    public $kpp;
    /** @var okpo */
    public $okpo;
    /** @var ogrn */
    public $ogrn;
    /** @var bank */
    public $bank;
    /** @var bik */
    public $bik;

    /** @var chief_fio */
    public $chief_fio;
    /** @var  chief_phone */
    public $chief_phone;

    /** @var chief_post */
    public $chief_post;
    /** @var chief_email */
    public $chief_email;

    /** @var manager_fio */
    public $manager_fio;
    /** @var manager_phone */
    public $manager_phone;

    /** @var float */
    public $percent_of_sale_order;
    /** @var float */
    public $percent_of_penalty;
    /** @var datetime */
    public $time_border;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email_login', 'filter', 'filter' => 'trim'],
            ['email_login', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['email_login', 'string', 'max' => 255, 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['email_login', 'match', 'pattern' => '/^[a-zA-Zа-яА-Я_\-\@\.0-9\s]+$/', 'message' => Yii::t('app/forms', 'error_login')],
            ['password', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['password', 'string', 'min' => 6, 'tooShort' => Yii::t('app/forms', 'error_too_short')],

            ['title', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['title', 'string', 'min' => 2, 'max' => 255, 'tooShort' => Yii::t('app/forms', 'error_too_short'), 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['title', 'match', 'pattern' => '/^[a-zA-Z\s0-9_\-\pL]+$/u', 'message' => Yii::t('app/forms', 'error_alphanumeric')],
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['name', 'string', 'min' => 2, 'max' => 255, 'tooShort' => Yii::t('app/forms', 'error_too_short'), 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['name', 'match', 'pattern' => '/^[a-zA-Z\s0-9_\-\pL]+$/u', 'message' => Yii::t('app/forms', 'error_alphanumeric')],

            ['dispatcher_phone', 'filter', 'filter' => 'trim'],
            ['dispatcher_phone', 'required', 'message' => Yii::t('app/forms', 'error_required')],

            ['physical_address', 'filter', 'filter' => 'trim'],
            ['physical_address', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['physical_address', 'string', 'max' => 255, 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['legal_address', 'filter', 'filter' => 'trim'],
            ['legal_address', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['legal_address', 'string', 'max' => 255, 'tooLong' => Yii::t('app/forms', 'error_too_long')],

            ['inn', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['inn', 'filter', 'filter' => 'trim'],
            ['inn', 'match', 'pattern' => '/^\d{10,12}$/', 'message' => Yii::t('app/forms', 'error_inn')],
            ['inn', 'integer'],
            ['kpp', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['kpp', 'filter', 'filter' => 'trim'],
            ['kpp', 'match', 'pattern' => '/^\d{9}$/', 'message' => Yii::t('app/forms', 'error_kpp')],
            ['kpp', 'integer'],

            ['okpo', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['okpo', 'filter', 'filter' => 'trim'],
            ['okpo', 'match', 'pattern' => '/^\d{8,10}$/', 'message' => Yii::t('app/forms', 'error_okpo')],
            ['okpo', 'integer'],
            ['ogrn', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['ogrn', 'filter', 'filter' => 'trim'],
            ['ogrn', 'match', 'pattern' => '/^\d{13}$/', 'message' => Yii::t('app/forms', 'error_ogrn')],
            ['ogrn', 'integer'],

            ['bank', 'filter', 'filter' => 'trim'],
            ['bank', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['bank', 'string', 'min' => 2, 'max' => 255, 'tooShort' => Yii::t('app/forms', 'error_too_short'), 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['bank', 'match', 'pattern' => '/^[a-zA-Z\s0-9_\-\pL]+$/u', 'message' => Yii::t('app/forms', 'error_alphanumeric')],
            ['bik', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['bik', 'integer'],
            ['bik', 'match', 'pattern' => '/^\d{9}$/', 'message' => Yii::t('app/forms', 'error_bik')],

            ['chief_fio', 'filter', 'filter' => 'trim'],
            ['chief_fio', 'required', 'message' => Yii::t('app/forms', 'required')],
            ['chief_fio', 'string', 'min' => 2, 'max' => 255, 'tooShort' => Yii::t('app/forms', 'error_too_short'), 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['chief_fio', 'match', 'pattern' => '/^[a-zA-Z\s\pL]+$/u', 'message' => Yii::t('app/forms', 'error_alphanumeric')],
            ['chief_phone', 'filter', 'filter' => 'trim'],
            ['chief_phone', 'required', 'message' => Yii::t('app/forms', 'error_required')],

            ['chief_post', 'filter', 'filter' => 'trim'],
            ['chief_post', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['chief_post', 'string', 'max' => 255, 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['chief_email', 'filter', 'filter' => 'trim'],
            ['chief_email', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['chief_email', 'email', 'message' => Yii::t('app/forms', 'error_email')],
            ['chief_email', 'string', 'max' => 255, 'tooShort' => Yii::t('app/forms', 'error_too_short')],
            [
                'chief_email',
                'unique',
                'targetClass' => 'app\models\CompanyChief',
                'targetAttribute' => 'email',
                'message' => Yii::t('app/form', 'error_unique')
            ],
            ['manager_fio', 'filter', 'filter' => 'trim'],
            ['manager_fio', 'required', 'message' => Yii::t('app/forms' , 'error_required')],
            ['manager_fio', 'string', 'min' => 2, 'max' => 255, 'tooShort' => Yii::t('app/forms', 'error_too_short'), 'tooLong' => Yii::t('app/forms', 'error_too_long')],
            ['manager_fio', 'match', 'pattern' => '/^[a-zA-Z\s0-9\pL]+$/u', 'message' => Yii::t('app/forms', 'error_alphanumeric')],
            ['manager_phone', 'filter', 'filter' => 'trim'],
            ['manager_phone', 'required', 'message' => Yii::t('app/forms', 'error_required')],

            ['percent_of_sale_order', 'filter', 'filter' => 'trim'],
            ['percent_of_sale_order', 'number', 'message' => Yii::t('app/forms', 'error_number')],

            ['percent_of_penalty', 'filter', 'filter' => 'trim'],
            ['percent_of_penalty', 'number', 'message' => Yii::t('app/forms', 'error_number')],

            ['time_border', 'filter', 'filter' => 'trim'],
            ['time_border', 'date', 'format' => 'yyyy-MM-dd', 'message' => Yii::t('app/forms', 'error_date')],
        ];
    }

    /**
     * Create new company with chief and manager.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function create()
    {
        if (!$this->validate()) return;

        $company = new Company();
        $company->name             = $this->name;
        $company->title            = $this->title;
        $company->dispatcher_phone = $this->formatPhone($this->dispatcher_phone);
        $company->physical_address = $this->physical_address;
        $company->legal_address    = $this->legal_address;
        $company->inn              = $this->inn;
        $company->kpp              = $this->kpp;
        $company->okpo             = $this->okpo;
        $company->ogrn             = $this->ogrn;
        $company->bank             = $this->bank;
        $company->bik              = $this->bik;

        if (!$company->save()) return;

        $setting = new CompanySetting();
        $setting->link('company', $company);

        $chief = new CompanyChief();

        list($first_name, $second_name, $last_name) = explode(' ', $this->chief_fio);
        $chief->first_name  = $first_name;
        $chief->second_name = $second_name;
        $chief->last_name   = $last_name;

        $chief->post = $this->chief_post;
        $chief->phone = $this->formatPhone($this->chief_phone);
        $chief->email = $this->chief_email;

        $chief->link('company', $company);

        unset($first_name, $second_name, $last_name);

        $user = new User();
        $user->password = $user->encodePassword($this->password);
        $user->phone    = $this->formatPhone($this->manager_phone);

        if (preg_match(self::EMAIL_PATTERN, $this->email_login)) {
            $user->email = $this->email_login;
        } else {
            $user->login = $this->email_login;
        }

        list($first_name, $second_name, $last_name) = explode(' ', $this->manager_fio);
        $user->first_name  = $first_name;
        $user->second_name = $second_name;
        $user->last_name   = $last_name;

        $user->link('company', $company);

        unset($first_name, $second_name, $last_name);

        return $company;
    }

    public function update($company = null)
    {
        if ($company === null) return;

        $company->name             = $this->name;
        $company->title            = $this->title;
        $company->dispatcher_phone = $this->formatPhone($this->dispatcher_phone);
        $company->physical_address = $this->physical_address;
        $company->legal_address    = $this->legal_address;
        $company->inn              = $this->inn;
        $company->kpp              = $this->kpp;
        $company->okpo             = $this->okpo;
        $company->ogrn             = $this->ogrn;
        $company->bank             = $this->bank;
        $company->bik              = $this->bik;

        if (!$company->save()) return;

        $setting = $company->getSetting()->one();
        $setting->settings = serialize([
            'percent_of_sale_order' => $this->percent_of_sale_order,
            'percent_of_penalty' => $this->percent_of_penalty,
            'time_border' => $this->time_border]);
        $setting->save();

        $chief = $company->getChief()->one();

        list($first_name, $second_name, $last_name) = explode(' ', $this->chief_fio);
        $chief->first_name  = $first_name;
        $chief->second_name = $second_name;
        $chief->last_name   = $last_name;

        $chief->post = $this->chief_post;
        $chief->phone = $this->formatPhone($this->chief_phone);
        $chief->email = $this->chief_email;

        if (!$chief->save()) return;

        unset($first_name, $second_name, $last_name);

        $user = $company->getManagers()->all()[0];
        $user->phone    = $this->formatPhone($this->manager_phone);

        if (preg_match(self::EMAIL_PATTERN, $this->email_login)) {
            $user->email = $this->email_login;
        } else {
            $user->login = $this->email_login;
        }

        list($first_name, $second_name, $last_name) = explode(' ', $this->manager_fio);
        $user->first_name  = $first_name;
        $user->second_name = $second_name;
        $user->last_name   = $last_name;

        if (!$user->save()) return;

        unset($first_name, $second_name, $last_name);

        return $company;

    }

    /**
     * Populate form with data.
     *
     * @param Company $company
     */
    public function populate($company = null)
    {
        if ($company === null) return;

        $chief   = $company->getChief()->one();
        $setting = $company->getSetting()->one();
        $manager = $company->getManagers()->all()[0];

        $this->name             = $company->name;
        $this->title            = $company->title;
        $this->dispatcher_phone = $company->dispatcher_phone;
        $this->physical_address = $company->physical_address;
        $this->legal_address    = $company->legal_address;
        $this->inn              = $company->inn;
        $this->kpp              = $company->kpp;
        $this->okpo             = $company->okpo;
        $this->ogrn             = $company->ogrn;
        $this->bank             = $company->bank;
        $this->bik              = $company->bik;

        $this->chief_fio   = implode(' ', [$chief->first_name, $chief->second_name, $chief->last_name]);
        $this->chief_post  = $chief->post;
        $this->chief_email = $chief->email;
        $this->chief_phone = $chief->phone;

        $this->manager_phone = $manager->phone;
        $this->email_login   = $manager->email ? $manager->email : $manager->login;
        $this->manager_fio   = implode(' ', [$manager->first_name, $manager->second_name, $manager->last_name]);

        $settings = $setting->getSettings();
        $this->percent_of_penalty    = $settings['percent_of_penalty'];
        $this->percent_of_sale_order = $settings['percent_of_sale_order'];
        $this->time_border           = $settings['time_border'];
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