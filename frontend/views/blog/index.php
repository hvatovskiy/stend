<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\blog\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Blog'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'linkdtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
