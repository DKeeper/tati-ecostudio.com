<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('view', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(isset($model->script)){
    $this->registerJs($model->script,yii\web\View::POS_LOAD);
}
?>
<div class="page-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'title:ntext',
            [
                'attribute' => 'content',
                'label' => $model->getAttributeLabel('content'),
                'format' => 'html',
            ],
            'script:ntext',
            'status',
            'output_order',
        ],
    ]) ?>

</div>