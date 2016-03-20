<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;
use yii\db\ActiveQuery;

/**
 * @property integer $company_id
 * @property string $settings
 *
 * @property Company $company
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class CompanySetting extends DtoModel implements HasDto
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'required'],
            [['company_id'], 'integer'],
            [['settings'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => Yii::t('app', 'Company ID'),
            'settings' => Yii::t('app', 'Settings'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * Get and unserialize value of settings field.
     *
     * @return array
     */
    public function getSettings()
    {
        $settings = $this->settings;

        return unserialize($settings);
    }

    /**
     * Set and serialize value of params field
     *
     * @param array $settings
     * @return null
     */
    public function setSettings($settings = array())
    {
        if (!is_array($settings)) return null;

        $this->settings = serialize($settings);
    }

    /**
     * @inheritdoc
     * @return CompanySettingQuery
     */
    public static function find()
    {
        return new CompanySettingQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(array(
           'settings'
        ));
    }
}
