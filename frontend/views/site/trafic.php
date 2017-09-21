<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
/* @var $model app\models\article\Article */
?>

<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 10000);
});

JS;
$this->registerJs($script);

?>

<?php
Pjax::begin(); ?>
<?php   $path="C:/xampp/htdocs/stend/frontend/".$model[$i]->newarticleurl ;  ?>
<?= Html::a("Обновить", ["site/trafic?i=$i"], ['class' => 'btn btn-lg btn-primary','id' => 'refreshButton']) ?>
    <h1> <?= $path; ?></h1>
<?php Pjax::end(); ?>

