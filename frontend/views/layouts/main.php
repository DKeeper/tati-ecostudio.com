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
            /** @var $activePages Page[] */
            $activePages = Page::find()->where(['status'=>1])->orderBy('output_order')->all();
            foreach($activePages as $page){
                if($page->name=='main') continue;
                $menuItems[] = ['label' => $page->title, 'url' => Url::toRoute(['/page/viewbyname','name' => $page->name])];
            }
            if (Yii::$app->user->isGuest) {
                $menuItems[] = [
                    'label' => Yii::t('view','Guest'),
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
            <div class="row">
                <div class="col-md-4 text-left">&copy; TATI-ecostudio <?= date('Y') ?></div>
                <div class="col-md-4 text-center">
                    <!-- Yandex.Metrika informer --><a href="http://metrika.yandex.ru/stat/?id=16346434&amp;from=informer" target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/16346434/3_0_FF4656FF_E32636FF_0_pageviews" style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:16346434,type:0,lang:'ru'});return false}catch(e){}"/></a><!-- /Yandex.Metrika informer --><!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter16346434 = new Ya.Metrika({id:16346434, enableAll: true, trackHash:true, webvisor:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/16346434" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
                    <!-- Rating@Mail.ru counter -->
                    <script type="text/javascript">//<![CDATA[
                    var a='',js=10;try{a+=';r='+escape(document.referrer);}catch(e){}try{a+=';j='+navigator.javaEnabled();js=11;}catch(e){}
                    try{s=screen;a+=';s='+s.width+'*'+s.height;a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;}catch(e){}
                    try{if(typeof((new Array).push('t'))==="number")js=13;}catch(e){}
                    try{document.write('<a href="http://top.mail.ru/jump?from=2236898">'+
                            '<img src="http://d1.c2.b2.a2.top.mail.ru/counter?id=2236898;t=59;js='+js+a+';rand='+Math.random()+
                            '" alt="Рейтинг@Mail.ru" style="border:0;" height="31" width="88" \/><\/a>');}catch(e){}//]]></script>
                    <noscript><p><a href="http://top.mail.ru/jump?from=2236898">
                        <img src="http://d1.c2.b2.a2.top.mail.ru/counter?js=na;id=2236898;t=59"
                             style="border:0;" height="31" width="88" alt="Рейтинг@Mail.ru" /></a></p></noscript>
                    <!-- //Rating@Mail.ru counter -->
                    <!-- begin of Top100 code -->
                    <script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?2759456"></script>
                    <noscript>
                        <a href="http://top100.rambler.ru/navi/2759456/">
                            <img src="http://counter.rambler.ru/top100.cnt?2759456" alt="Rambler's Top100" border="0" />
                        </a>
                    </noscript>
                    <!-- end of Top100 code -->
                </div>
                <div class="col-md-4 text-right"><?= Yii::powered() ?></div>
            </div>
        </div>
    </footer>
    <?php $this->head() ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
