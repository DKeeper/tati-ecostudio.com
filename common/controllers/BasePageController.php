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
        return $this->renderPartial('@common/views/works/viewinline',[
            'model' => Works::findOne($matches[1])
        ]);
    }
}
