<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 19.07.14
 * @time 17:49
 * Created by JetBrains PhpStorm.
 */
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'roles' => ['admin'],
                        'allow' => true,
                    ],
                ],
            ],
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
        $_im = new \Imagick($fileName);
        header('Content-Type: '.$_im->getimagemimetype());
        readfile($fileName);
        Yii::$app->end();
    }
}