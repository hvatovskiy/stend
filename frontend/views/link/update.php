<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\link\Link */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Link',
]) . $model->idlink;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlink, 'url' => ['view', 'id' => $model->idlink]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
