<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\Page;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'TATI-ecostudio',
                'brandUrl' => Url::toRoute(['/page/viewbyname','name' => 'main']),
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/user/login']];
            } else {
                if(Yii::$app->user->can("admin")){
                    /** @var $activePages Page[] */
                    $activePages = Page::find()->where(['status'=>1])->orderBy('output_order')->all();
                    foreach($activePages as $page){
                        if($page->name=='main') continue;
                        $menuItems[] = ['label' => $page->title, 'url' => Url::toRoute(['/page/viewbyname','name' => $page->name])];
                    }
                    $menuItems[] = [
                        'label' => Yii::$app->user->displayName,
                        'items' => [
                            ['label' => 'User', 'url' => ['/user/admin']],
                            ['label' => 'Page', 'url' => ['/page/']],
                            '<li class="divider"></li>',
                            ['label' => 'Account', 'url' => ['/user/account']],
                            ['label' => 'Profile', 'url' => ['/user/profile']],
                            '<li class="divider"></li>',
                            ['label' => 'Logout', 'url' => ['/user/logout'],'linkOptions' => ['data-method' => 'post']],
                        ]
                    ];
                } else {
                    $menuItems[] = ['label' => 'Logout ('.Yii::$app->user->displayName.')', 'url' => ['/user/logout'],'linkOptions' => ['data-method' => 'post']];
                }
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; TATI-ecostudio <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
