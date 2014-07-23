<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 23.07.14
 * @time 22:54
 * Created by JetBrains PhpStorm.
 */

namespace common\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BaseFilesController extends Controller
{
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

    public function actionResize($param,$src){
        if(preg_match('/picture/',$src)){
            $src = preg_replace('/picture\//','',$src);
        }
        $file = Yii::getAlias("@app")."/../".$src;
        $fileName = basename($file);
        $resizeDir = dirname($file).'/resize';
        if(!is_dir($resizeDir)){
            mkdir($resizeDir);
        }
        $fullResizeFile = $resizeDir.'/'.$param.'_'.$fileName;
        if(!file_exists($fullResizeFile)){
            // Create img
            list($newWidth, $newHeight) = explode('x',$param);
            list($width, $height) = getimagesize($file);
            $im = imagecreatefromstring(file_get_contents($file));
            $thumb = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresized($thumb, $im, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagepng($thumb,$fullResizeFile);
            imagedestroy($thumb);
            imagedestroy($im);
            unset($thumb,$im);
        }
        header('Content-Type: '.exif_imagetype($fullResizeFile));
        readfile($fullResizeFile);
        Yii::$app->end();
    }
}
