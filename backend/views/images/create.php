<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Images */

$this->title = Yii::t('view', 'Create {modelClass}', [
    'modelClass' => 'Images',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('view', 'Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
