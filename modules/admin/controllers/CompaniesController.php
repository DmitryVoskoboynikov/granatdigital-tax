<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Company;
use app\models\CompanySearch;
use app\models\CompanyForm;
use app\models\CompanySetting;
use app\models\CompanySettingForm;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Companies Controller.
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class CompaniesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists of all Company models.
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $companySettingForm = new CompanySettingForm();

        $company         = $this->findModel($id);
        $setting         = $company->getSetting()->one();
        $chief           = $company->getChief()->one();
        $managers        = $company->getManagers()->all();

        $companySettingForm->setAttributes($setting->getSettings());

        return $this->render('view', [
            'company'          => $company,
            'chief'            => $chief,
            'managers'         => $managers,
            'company_settings' => $companySettingForm,
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyForm();

        if ($model->load(Yii::$app->request->post()) && ($company = $model->create())) {
            return $this->redirect(['view', 'id' => $company->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     *
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $company         = $this->findModel($id);
        $model           = new CompanyForm();

        if ($model->load(Yii::$app->request->post()) && $model->update($company)) {
            return $this->redirect(['view', 'id' => $company->id]);
        } else {
            $model->populate($company);

            return $this->render('update', [
                'model'           => $model,
                'company'         => $company,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model connot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exists.');
        }
    }
}
