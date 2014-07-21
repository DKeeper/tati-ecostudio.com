<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 19.07.14
 * @time 17:49
 * Created by JetBrains PhpStorm.
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImagesController implements the CRUD actions for Images model.
 */
class FilesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Images models.
     * @param $src
     * @throws \yii\web\NotFoundHttpException
     * @return mixed
     */
    public function actionIndex($src)
    {
        if(preg_match('/picture/',$src)){
            $src = preg_replace('/picture\//','',$src);
        }
        $fileName = Yii::getAlias("@app")."/../".$src;
        if(!file_exists($fileName)){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        header('Content-Type: '.exif_imagetype($fileName));
        readfile($fileName);
        Yii::$app->end();
    }
}