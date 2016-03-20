<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app/signup', 'signup');

?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php if ($message == null): ?>
            <div class="col-lg-5">
                <p>Please fill out the following fields to signup:</p>

                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'email_login')->label(Yii::t('app/signup', 'login')) ?>
                <?= $form->field($model, 'password')->label(Yii::t('app/signup', 'password'))->passwordInput() ?>

                <?= $form->field($model, 'title')->label(Yii::t('app/signup', 'title')) ?>
                <?= $form->field($model, 'name')->label(Yii::t('app/signup', 'name')) ?>

                <?= $form->field($model, 'dispatcher_phone')->label(Yii::t('app/signup', 'dispatcher_phone')) ?>

                <?= $form->field($model, 'physical_address')->label(Yii::t('app/signup', 'physical_address')) ?>
                <?= $form->field($model, 'legal_address')->label(Yii::t('app/signup', 'legal_address')) ?>

                <?= $form->field($model, 'inn')->label(Yii::t('app/signup', 'inn')) ?>
                <?= $form->field($model, 'kpp')->label(Yii::t('app/signup', 'kpp')) ?>

                <?= $form->field($model, 'okpo')->label(Yii::t('app/signup', 'okpo')) ?>
                <?= $form->field($model, 'ogrn')->label(Yii::t('app/signup', 'ogrn')) ?>

                <?= $form->field($model, 'bank')->label(Yii::t('app/signup', 'bank')) ?>
                <?= $form->field($model, 'bik')->label(Yii::t('app/signup', 'bik')) ?>

                <?= $form->field($model, 'chief_fio')->label(Yii::t('app/signup', 'chief_fio')) ?>
                <?= $form->field($model, 'chief_phone')->label(Yii::t('app/signup', 'chief_phone')) ?>

                <?= $form->field($model, 'chief_post')->label(Yii::t('app/signup', 'chief_post')) ?>
                <?= $form->field($model, 'chief_email')->label(Yii::t('app/signup', 'chief_email')) ?>

                <?= $form->field($model, 'manager_fio')->label(Yii::t('app/signup', 'manager_fio')) ?>
                <?= $form->field($model, 'manager_phone')->label(Yii::t('app/signup', 'manager_phone')) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app/signup', 'signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

               <?php ActiveForm::end(); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-success">
                    <strong>Success!</strong> <?= $message ?>
            </div>
        <?php endif ?>
    </div>
</div>