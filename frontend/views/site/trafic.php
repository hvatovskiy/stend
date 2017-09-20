<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
/* @var $model app\models\article\Article */
?>

<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 3000);
});
JS;
$this->registerJs($script);
?>

<?php
Pjax::begin(); ?>
<?= Html::a("Обновить", ['site/trafic'], ['class' => 'btn btn-lg btn-primary','id' => 'refreshButton']) ?>
    <h1> <?= $path  ?></h1>
<?php Pjax::end(); ?>
// теперь надо выводить html файлик который находится по $path
