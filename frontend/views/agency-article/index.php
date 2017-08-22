<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\agencyarticle\AgencyArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Agency Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Agency Article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idlink',
            'linkname',
            'linkdtime',
            // 'article_idarticle',
            // 'agency_idagency',
            [
                'attribute' => 'agencyIdagency',
                'value' => 'agencyIdagency.agencyname',
                'label' => 'Agency Name',
            ],
            [
                'attribute' => 'articleIdarticle',
                'value' => 'articleIdarticle.articletitle',
                'label' => 'Article Title',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
