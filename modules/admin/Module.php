<?php

namespace app\modules\admin;

/**
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public $layout = 'admin';

    public function init()
    {
        parent::init();
    }
}
