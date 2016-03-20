<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * @property integer $id
 * @property string $params
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class Settings extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['id'], 'unique'],
            [['params'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [];
    }

    /**
     * Get and unserialize value of params field.
     *
     * @return array
     */
    public function getParams()
    {
         $params = $this->params;

         return unserialize($params);
    }

    /**
     * Set and serialize value of params field
     *
     * @param array $params
     * @return null
     */
    public function setParams($params = array())
    {
        if (!is_array($params)) return null;

        $this->params = serialize($params);
    }

    /**
     * @inheritdoc
     * @return OptionQuery
     */
    public static function find()
    {
        return new SettingsQuery(get_called_class());
    }
}
