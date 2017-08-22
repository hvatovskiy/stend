<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idarticle',
            'articletitle',
			//'description:ntext',
            'articleurl:url',
			'newarticleurl:url',
            //'isworkurl:url',
            'articledtime',

            [
                'class' => ActionColumn::className(),
				'template' => '{view} {update} {delete} {link}',
				'buttons' => [
					'link' => function ($url, $model, $key) {
						return Html::a('Goto link', $url);
					},
                    'view' => function ($url, $model, $key) {
                        return Html::a('Detail view', $url);
                    },

					'update' => function ($url, $model, $key) {
						return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
							'title' => Yii::t('yii', 'Update data'),
							'data-pjax' => '0',
						]);
					},
					'delete' => function ($url, $model, $key) {
						return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
							'title' => Yii::t('yii', 'Delete data'),
							'data-confirm' => 'Are you sure you want to delete?',
							'data-method' => 'post',
							'data-pjax' => '0',
						]);
					},

				],
			],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
