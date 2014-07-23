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
use common\controllers\BaseFilesController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImagesController implements the CRUD actions for Images model.
 */
class FilesController extends BaseFilesController
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
}