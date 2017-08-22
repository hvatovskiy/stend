<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use frontend\models\user\User;
use frontend\models\message\Message;

use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\blog\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idlink')->textInput() ?>

    <?= $form->field($model, 'linkname')->textInput(['maxlength' => true]) ?>



    <?php
    $userIduserfrom = User::find()->all();
    $items = ArrayHelper::map($userIduserfrom, 'id', 'username');
    $params = [
        'prompt' => 'Выберите пользователя-отправителя...'
    ]; ?>
    <?= $form->field($model, 'user_iduserfrom')->dropDownList($items, $params); ?>
    <!-- <?//= $form->field($model, 'user_iduserfrom')->textInput() ?> -->

    <?php
    $userIduserto = User::find()->all();
    $items = ArrayHelper::map($userIduserto, 'id', 'username');
    $params = [
        'prompt' => 'Выберите пользователя-получателя...'
    ]; ?>
    <?= $form->field($model, 'user_iduserto')->dropDownList($items, $params); ?>
    <!-- <?//= $form->field($model, 'user_iduserto')->textInput() ?> -->

    <?php
    $messageIdmessage = Message::find()->all();
    $items = ArrayHelper::map($messageIdmessage, 'idmessage', 'msgcontent');
    $params = [
        'prompt' => 'Выберите сообщение...'
    ]; ?>
    <?= $form->field($model, 'message_idmessage')->dropDownList($items, $params); ?>
    <!-- <?//= $form->field($model, 'message_idmessage')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'linkdtime')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Время создания...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
            'todayHighlight' => true
        ]]); ?>
    <!-- <?/*= $form->field($model, 'linkdtime')->textInput() */?> -->

    <?php ActiveForm::end(); ?>

</div>
