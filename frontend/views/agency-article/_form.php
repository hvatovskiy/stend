<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use frontend\models\agency\Agency;
use frontend\models\article\Article;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\agencyarticle\AgencyArticle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agency-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idlink')->textInput() ?>

    <?= $form->field($model, 'linkname')->textInput(['maxlength' => true]) ?>

    <?php
    $agencyIdagency = Agency::find()->all();
    $items = ArrayHelper::map($agencyIdagency, 'idagency', 'agencyname');
    $params = [
        'prompt' => 'Выберите агентство...'
    ]; ?>
    <?= $form->field($model, 'agency_idagency')->dropDownList($items, $params); ?>
    <!-- <?/*= $form->field($model, 'agency_idagency')->textInput() */?> -->

    <?php
    $articleIdarticle = Article::find()->all();
    $items = ArrayHelper::map($articleIdarticle, 'idarticle', 'articletitle');
    $params = [
        'prompt' => 'Выберите статью...'
    ]; ?>
    <?= $form->field($model, 'article_idarticle')->dropDownList($items, $params); ?>
    <!-- <?/*= $form->field($model, 'article_idarticle')->textInput() */?> -->

    <?= $form->field($model, 'linkdtime')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Время создания...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
            'todayHighlight' => true
        ]]); ?>
    <!-- <?/*= $form->field($model, 'linkdtime')->textInput() */?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
