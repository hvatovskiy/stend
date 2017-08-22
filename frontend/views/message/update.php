<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\message\Message */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Message',
]) . $model->idmessage;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmessage, 'url' => ['view', 'id' => $model->idmessage]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
