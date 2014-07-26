<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 23.07.14
 * @time 17:34
 * Created by JetBrains PhpStorm.
 */

namespace common\controllers;

use Yii;
use yii\web\Controller;
use common\models\Page;
use common\models\Works;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\helpers\Html;

class BasePageController extends Controller
{
    /**
     * @param string $name
     * @return string
     */
    public function actionViewbyname($name){
        return $this->render('viewpagecontent', [
            'model' => $this->findModelByName($name),
        ]);
    }

    /**
     * @param integer $name
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByName($name){
        /** @var $model Page */
        if (($model = Page::findOne(['name'=>$name])) !== null) {
            $model->content = preg_replace_callback(
                '`{{work_(\d+)}}`',
                'self::insertWorks',
                $model->content
            );
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function insertWorks($matches){
        /** @var $work Works */
        $work = Works::findOne($matches[1]);
        $_result = '<div class="row work_row">';
        $_result .= '<div class="panel panel-default">';
        $_result .= '<div class="panel-heading">';
        $_result .= '<h5>'.Html::a($work->name,Url::toRoute(['works/view', 'id' => $work->id])).'</h5>';
        $_result .= '</div>';
        $_result .= '<div class="panel-body">';
        $_result .= '<div class="col-md-12">';
        $_result .= $work->description;
        $_result .= '</div>';
        $_images = [];
        if(count($work->images)){
            foreach($work->images as $image){
                $_images[] = ['img'=>'/files'.$image->link,'thumb'=>'/files/60x60'.$image->link];
            }
        }
        $_result .= '<div class="center-block"><div class="col-md-12">';
        $mobileDetect = Yii::$app->params['detect'];
        $maxWidth = 600;
        if($mobileDetect['isTablet']){
            $maxWidth = 500;
        }
        if($mobileDetect['isMobile']){
            $maxWidth = 300;
        }
        $_result .= \metalguardian\fotorama\Fotorama::widget(
            [
                'items' => $_images,
                'options' => [
                    'nav' => 'thumbs',
                    'maxwidth' => $maxWidth
                ]
            ]
        );
        $_result .= '</div></div>';
        $_result .= '</div>';
        $_result .= '</div>';
        $_result .= '</div>';
        return $_result;
    }
}
