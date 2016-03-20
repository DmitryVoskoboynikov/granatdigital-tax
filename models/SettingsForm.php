<?php

namespace app\models;

use yii\base\Model;
use Yii;
use app\models\Settings;

/**
 * Settings form
 *
 * @author Voskoboynikov Dmitry <voskoboynikov@granat-digital.ru>
 */
class SettingsForm extends Model
{
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
            ['percent_of_sale_order', 'filter', 'filter' => 'trim'],
            ['percent_of_sale_order', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['percent_of_sale_order', 'number', 'message' => Yii::t('app/forms', 'error_number')],

            ['percent_of_penalty', 'filter', 'filter' => 'trim'],
            ['percent_of_penalty', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['percent_of_penalty', 'number', 'message' => Yii::t('app/forms', 'error_number')],

            ['time_border', 'filter', 'filter' => 'trim'],
            ['time_border', 'required', 'message' => Yii::t('app/forms', 'error_required')],
            ['time_border', 'date', 'format' => 'yyyy-MM-dd', 'message' => Yii::t('app/forms', 'error_date')],
        ];
    }

    /**
     * System settings save
     *
     * @return Settings|null the saved model or null if saving fails
     */
    public function save()
    {
        if (!$this->validate()) return;

        $settings = Settings::find()->getSettings();

        $params = [
            'percent_of_sale_order' => $this->percent_of_sale_order,
            'percent_of_penalty'    => $this->percent_of_penalty,
            'time_border' => $this->time_border,
        ];

        $settings->params = serialize($params);
        $settings->save();

        return $settings;
    }
}
