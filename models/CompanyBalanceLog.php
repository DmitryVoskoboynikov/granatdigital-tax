<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $company_id
 * @property string $created_at
 * @property string $value
 * @property string $message
 *
 * @property Company $company
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class CompanyBalanceLog extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_balance_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'required'],
            [['company_id'], 'integer'],
            [['created_at'], 'safe'],
            [['value'], 'number'],
            [['message'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => Yii::t('app', 'Company ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'value' => Yii::t('app', 'Value'),
            'message' => Yii::t('app', 'Message'),
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
     * @inheritdoc
     * @return CompanyBalanceLogQuery
     */
    public static function find()
    {
        return new CompanyBalanceLogQuery(get_called_class());
    }
}
