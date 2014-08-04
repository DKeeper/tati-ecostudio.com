<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 19.07.14
 * @time 21:14
 * Created by JetBrains PhpStorm.
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'] = [];
$this->params['breadcrumbs'][] = $this->title;
if(isset($model->script)){
    $this->registerJs($model->script,yii\web\View::POS_LOAD);
}
?>
<p>
    <?= Html::a(Yii::t('view', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('view', 'Delete'), ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => Yii::t('view', 'Are you sure you want to delete this item?'),
        'method' => 'post',
    ],
]) ?>
</p>
<?= $model->content; ?>
