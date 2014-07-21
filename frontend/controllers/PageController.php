<?php

namespace frontend\controllers;

use Yii;
use common\models\Page;
use common\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
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
        if (($model = Page::findOne(['name'=>$name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
