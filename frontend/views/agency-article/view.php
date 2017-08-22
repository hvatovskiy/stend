<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\agencyarticle\AgencyArticle */

$this->title = $model->idlink;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agency Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idlink], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idlink], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idlink',
            'linkname',

            'agencyIdagency.agencyname',
            //'agency_idagency',
            'articleIdarticle.articletitle',
            //'article_idarticle',
            'linkdtime',
        ],
    ]) ?>

</div>
