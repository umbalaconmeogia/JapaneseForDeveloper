<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;

NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'PatternStatistic', 'url' => ['/test-statistic/test-pattern-statistic']],
        ['label' => 'StatisticFile', 'url' => ['/test-statistic/statistic-file']],
//         ['label' => 'Home', 'url' => ['/site/index']],
//         ['label' => 'About', 'url' => ['/site/about']],
//         ['label' => 'Contact', 'url' => ['/site/contact']],
//         Yii::$app->user->isGuest ? (
//             ['label' => 'Login', 'url' => ['/site/login']]
//             ) : (
//                 '<li>'
//                 . Html::beginForm(['/site/logout'], 'post')
//                 . Html::submitButton(
//                     'Logout (' . Yii::$app->user->identity->username . ')',
//                     ['class' => 'btn btn-link logout']
//                     )
//                 . Html::endForm()
//                 . '</li>'
//                 )
    ],
]);
NavBar::end();
?>
