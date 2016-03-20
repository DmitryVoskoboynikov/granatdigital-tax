<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

use app\models\User;
use app\models\ManagerSearch;
use app\models\ManagerForm;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Managers Controller.
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class ManagersController extends Controller
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
     * Lists of all Managers models.
     */
    public function actionIndex()
    {
        $searchModel = new ManagerSearch();
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
        $manager = $this->findModel($id);

        return $this->render('view', [
            'manager' => $manager,
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
        $model = new ManagerForm();

        if ($model->load(Yii::$app->request->post()) && ($model->save())) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        $model = $this->findForm($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'           => $model,
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model can not be found
     */
    protected function findModel($id)
    {
        if (($model = User::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exists.');
        }
    }

    /** Finds the ManagerForm model base on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ManagerForm the loaded model
     * @throws NotFoundHttpException if the model can not be found
     */
    protected function findForm($id)
    {
        if (($form = ManagerForm::find()->where(['id' => $id])->one()) !== null) {
            return $form;
        } else {
            throw new NotFoundHttpException('The requested page does not exists.');
        }
    }
}
