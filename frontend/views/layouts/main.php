<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
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
//            $menuItems = [
//                ['label' => 'Home', 'url' => ['/site/index']],
//                ['label' => 'About', 'url' => ['/site/about']],
//                ['label' => 'Contact', 'url' => ['/site/contact']],
//                ['label' => 'User', 'url' => ['/user']],
//            ];
            /** @var $activePages Page[] */
            $activePages = Page::find()->where(['status'=>1])->orderBy('output_order')->all();
            foreach($activePages as $page){
                if($page->name=='main') continue;
                $menuItems[] = ['label' => $page->title, 'url' => Url::toRoute(['/page/viewbyname','name' => $page->name])];
            }
            if (Yii::$app->user->isGuest) {
                $menuItems[] = [
                    'label' => Yii::$app->user->displayName,
                    'items' => [
                        ['label' => 'Signup', 'url' => ['/user/register']],
                        ['label' => 'Login', 'url' => ['/user/login']]
                    ]
                ];
            } else {
                $subItems = [];
                if(Yii::$app->user->can("admin")){
                    $subItems = [
                        ['label' => 'Admin', 'url' => Yii::$app->urlManager->createAbsoluteUrl('/admin')],
                        ['label' => 'Users', 'url' => Yii::$app->urlManager->createAbsoluteUrl('/admin/user/admin')],
                        '<li class="divider"></li>',
                    ];
                }
                $subItems = array_merge($subItems,[
                    ['label' => 'Account', 'url' => ['/user/account']],
                    ['label' => 'Profile', 'url' => ['/user/profile']],
                    '<li class="divider"></li>',
                    ['label' => 'Logout', 'url' => ['/user/logout'],'linkOptions' => ['data-method' => 'post']]
                ]);
                $menuItems[] = [
                    'label' => Yii::$app->user->displayName,
                    'items' => $subItems,
                ];
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
        <?= Alert::widget() ?>
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
