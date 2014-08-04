<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 04.08.14
 * @time 9:50
 * Created by JetBrains PhpStorm.
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Works */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('view', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row work_row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5><?= Html::a($model->name,Url::toRoute(['works/view', 'id' => $model->id])) ?></h5>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <?= $model->description ?>
            </div>
            <?php
            $_images = [];
            foreach($model->images as $image){
                $_images[] = ['img'=>'/files'.$image->link,'thumb'=>'/files/60x60'.$image->link];
            }
            ?>
            <div class="center-block">
                <div class="col-md-12">
                <?php
                $mobileDetect = Yii::$app->params['detect'];
                $maxWidth = 600;
                if($mobileDetect['isTablet']){
                    $maxWidth = 500;
                }
                if($mobileDetect['isMobile']){
                    $maxWidth = 300;
                }
                ?>
                <?= \metalguardian\fotorama\Fotorama::widget([
                    'items' => $_images,
                    'options' => [
                        'nav' => 'thumbs',
                        'maxwidth' => $maxWidth
                    ]
                ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>