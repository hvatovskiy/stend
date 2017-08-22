<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\agency\Agency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idagency')->textInput() ?>

    <?= $form->field($model, 'agencyname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agencywebsite')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
