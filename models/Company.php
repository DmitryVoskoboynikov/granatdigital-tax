<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\models\User;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $balance
 * @property integer $owner_id
 * @property string $status_id
 *
 * @property ClientMessage[] $clientMessages
 * @property User $id0
 * @property CompanyBalanceLog $companyBalanceLog
 * @property CompanySetting $companySetting
 * @property UploadedFile[] $uploadedFiles
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class Company extends DtoModel implements HasDto
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['balance'], 'number'],
            [['owner_id'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['title'], 'string', 'max' => 200],
            [['status_id'], 'string', 'max' => 45],
            [['dispatcher_phone'], 'number'],
            [['legal_address'], 'string'],
            [['physical_address'], 'string'],
            [['inn'], 'number'],
            [['kpp'], 'number'],
            [['bank'], 'string'],
            [['bik'], 'number'],
            [['okpo'], 'number'],
            [['ogrn'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'title' => Yii::t('app', 'Title'),
            'balance' => Yii::t('app', 'Balance'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'status_id' => Yii::t('app', 'Status ID'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getClientMessages()
    {
        return $this->hasMany(ClientMessage::className(), ['company_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCompanyBalanceLog()
    {
        return $this->hasOne(CompanyBalanceLog::className(), ['company_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUploadedFiles()
    {
        return $this->hasMany(UploadedFile::className(), ['company_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getChief()
    {
        return $this->hasOne(CompanyChief::className(), ['company_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSetting()
    {
        return $this->hasOne(CompanySetting::className(), ['company_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getManagers()
    {
        return $this->hasMany(User::className(), ['company_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CompanyQuery
     */
    public static function find()
    {
        return new CompanyQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(
            array(
                'id',
                'name'
            )
        );
    }
}
