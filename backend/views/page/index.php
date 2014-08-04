<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('view', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('view', 'Create {modelClass}', [
    'modelClass' => 'Page',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'title:ntext',
            [
                'class' => DataColumn::className(),
                'attribute' => 'status',
                'content' => function($data) { return $data->status?Yii::t("view","Active"):Yii::t("view","Inactive"); },
                'filter' => ['1'=>Yii::t("view","Active"),'0'=>Yii::t("view","Inactive")],
            ],
            'output_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
