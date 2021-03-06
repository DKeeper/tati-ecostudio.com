<?php
if(getenv('WWW_ENV') == 'DEV'){
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', false);
    defined('YII_ENV') or define('YII_ENV', 'prod');
}

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/aliases.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

$application = new yii\web\Application($config);

Yii::$app->on(\yii\base\Application::EVENT_BEFORE_REQUEST,function($event){
    // Add rule for pages
    $names = [];
    $rows = (new \yii\db\Query())
        ->select('name')
        ->from(common\models\Page::tableName())
        ->where(['status'=>1])
        ->orderBy('output_order')
        ->all();
    foreach($rows as $row){
        $names[] = $row['name'];
    }
    $names = implode('|',$names);
    $rule = ['<name('.$names.')>' => 'page/viewbyname'];
    Yii::$app->urlManager->addRules($rule,false);
    // Mobile detect
    Yii::$app->params['detect'] = [
        'isMobile' => Yii::$app->mobiledetect->isMobile(),
        'isTablet' => Yii::$app->mobiledetect->isTablet(),
    ];
});

$application->run();