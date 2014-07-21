<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Works */

$this->title = Yii::t('view', 'Create {modelClass}', [
    'modelClass' => 'Works',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('view', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
