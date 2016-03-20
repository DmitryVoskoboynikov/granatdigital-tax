<?php

namespace app\models;

use yii\base\Model;
use Yii;
use app\models\Company;

/**
 * Company Settings form
 *
 * @author Voskoboynikov Dmitry <voskoboynikov@granat-digital.ru>
 */
class CompanySettingForm extends Model
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
}
