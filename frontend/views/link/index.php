<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\link\LinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Link'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idlink',
            'linkname',
            [
                'attribute' => 'userIduserfrom',
                'value' => 'userIduserfrom.username',
                'label' => 'User From Name',
            ],
            [
                'attribute' => 'userIduserto',
                'value' => 'userIduserto.username',
                'label' => 'User To Name',
            ],
            [
                'attribute' => 'messageIdmessage',
                'value' => 'messageIdmessage.msgcontent',
                'label' => 'Message Content',
            ],
            //'user_iduserfrom',
            //'user_iduserto',
            //'message_idmessage',
            
            //'agency_idagency',
			//'article_idarticle',			
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
            'linkdtime',
			
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
