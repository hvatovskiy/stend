<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
/* @var $model app\models\article\Article */
?>

<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 1000); //10 sec
});
                                        

// каждый раз передаю всю выборку, передавать нужно только 1 статью
// каждый раз передаю всю выборку, передавать нужно только 1 статью
// каждый раз передаю всю выборку, передавать нужно только 1 статью


JS;
$this->registerJs($script);

?>

<?php
Pjax::begin(); ?>

<?php  $dir=str_replace('\\',"/",Yii::$app->basePath);
$path=$model[$i]->newarticleurl;
if(file_exists($dir.'/'.$path))$article=file_get_contents($dir.'/'.$path) ; else $article="добавить эту статейку" ?>
<?= Html::a("Обновить", ["site/trafic?i=$i"], ['class' => 'btn btn-lg btn-primary','id' => 'refreshButton']) ?>
    <h1> <?= $article; ?></h1>
<?php Pjax::end(); ?>

