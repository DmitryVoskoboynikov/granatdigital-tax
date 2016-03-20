<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Settings;
use app\models\SettingsForm;

use yii\web\NotFoundHttpException;

/**
 * Settings Controller.
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class SettingsController extends Controller
{
    /**
     * Show settings form
     * @return mixed
     */
    public function actionIndex()
    {
        $model    = new SettingsForm();

        $settings = $this->findSettings();
        $model->setAttributes($settings->getParams());

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed
     */
    public function actionUpdate()
    {
        $model    = new SettingsForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app/settings', 'success'));

            return $this->redirect(['index']);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findSettings($id = 1)
    {
        if (($model = Settings::find()->getSettings($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested record does not exist.');
        }
    }
}
