<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\agency\Agency */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Agency',
]) . $model->idagency;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idagency, 'url' => ['view', 'id' => $model->idagency]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="agency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
