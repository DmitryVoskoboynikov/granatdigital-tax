<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "company_chief".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $first_name
 * @property integer $second_name
 * @property integer $last_name
 * @property string $phone
 * @property string $email
 * @property string $post
 *
 * @author Voskoboynikov Dmitry <voskoboynikov@granat-digital.ru>
 */
class CompanyChief extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_chief';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'second_name', 'last_name', 'post', 'phone', 'email'], 'required'],
            [['email', 'post'], 'string', 'max' => 60],
            [['first_name', 'second_name', 'last_name'], 'string', 'max' => 45],
            [['phone'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
