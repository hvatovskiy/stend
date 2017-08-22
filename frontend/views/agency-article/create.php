<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\agencyarticle\AgencyArticle */

$this->title = Yii::t('app', 'Create Agency Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agency Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
