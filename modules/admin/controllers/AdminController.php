<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

/**
 * Admin Controller.
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class AdminController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}