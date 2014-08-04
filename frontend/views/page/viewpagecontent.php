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
echo $model->content;
?>
