<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\agencyarticle\AgencyArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agency-article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idlink') ?>

    <?= $form->field($model, 'linkname') ?>

    <?= $form->field($model, 'linkdtime') ?>

    <?= $form->field($model, 'user_iduserfrom') ?>

    <?= $form->field($model, 'user_iduserto') ?>

    <?php // echo $form->field($model, 'message_idmessage') ?>

    <?php // echo $form->field($model, 'article_idarticle') ?>

    <?php // echo $form->field($model, 'agency_idagency') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
