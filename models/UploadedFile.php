<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $owner_id
 * @property string $path
 * @property integer $size
 * @property string $mime
 * @property integer $company_id
 *
 * @property Company $company
 * @property User $owner
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class UploadedFile extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uploaded_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'owner_id', 'size', 'company_id'], 'integer'],
            [['path'], 'string', 'max' => 200],
            [['mime'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'path' => Yii::t('app', 'Path'),
            'size' => Yii::t('app', 'Size'),
            'mime' => Yii::t('app', 'Mime'),
            'company_id' => Yii::t('app', 'Company ID'),
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
     * @return ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @inheritdoc
     * @return UploadedFileQuery
     */
    public static function find()
    {
        return new UploadedFileQuery(get_called_class());
    }
}
