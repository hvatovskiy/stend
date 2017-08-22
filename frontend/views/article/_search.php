<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idarticle') ?>

    <?= $form->field($model, 'articletitle') ?>

    <?= $form->field($model, 'articleurl') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'newarticleurl') ?>

    <?php // echo $form->field($model, 'isworkurl') ?>

    <?php // echo $form->field($model, 'articledtime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
