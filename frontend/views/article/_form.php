<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\FileInput;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\article\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'articletitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'articleurl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'newarticleurl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isworkurl')->textInput() ?>

    <?= $form->field($model, 'articledtime')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Время публикации...'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:ii:ss',
                'todayHighlight' => true   
            ]                                
        ]); ?>
		
	<!-- <?/*= FileInput::widget([
		'name' => 'input-ru[]',
		'language' => 'ru',
		'options' => ['multiple' => true],
		'pluginOptions' => ['previewFileType' => 'any', 'uploadUrl' => Url::to(['/site/file-upload']),]
	]); */ ?> -->

    <?= FileInput::widget([
            'name' => 'attachment_3',
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
	
    <?php ActiveForm::end(); ?>

</div>
