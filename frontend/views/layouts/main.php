<?php

/* @var $this View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top',
            //'class' => 'navbar navbar-dark bg-primary',
            'id' => 'nav_bar',
        ],

        'renderInnerContainer' => true,
        'innerContainerOptions' => [
            'class' => 'container'
        ],

        //'brandLabel' => Yii::$app->name,
        'brandLabel' => 'Автошкола Гармония',
        'brandUrl' => Yii::$app->homeUrl,
    ]);


    if (Yii::$app->user->can('admin')) {     //Админ
        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            //['label' => 'Заявления', 'url' => ['/application/index']],
            ['label' => 'Заявления', 'url' => ['/application?sort=-updated_at']],
            ['label' => 'Пользователи', 'url' => ['/user/index']],
        ];
    } elseif  (Yii::$app->user->can('instructor')) {     //Инструктор
        $menuItems = [
            ['label' => 'Личный кабинет', 'url' => ['/user/account?id='.Yii::$app->user->identity->id]],
        ];
    } else {     //Пользователь
        $menuItems = [
            //['label' => 'Главная', 'url' => ['/site/index']],
            //['label' => 'Личный кабинет', 'url' => ['/user/account?id='.Yii::$app->user->identity->id]],
        ];
    }

    if (Yii::$app->user->isGuest) {
        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Заявление', 'url' => ['/application/age']],
            ['label' => 'Войти', 'url' => ['/site/login']],
        ];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
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

        <div class="pull-left"> <?= Html::a('ул. Карла Либкнехта, 24&emsp;', 'https://goo.gl/maps/PtMSocJsKi6hmcUn6') ?> </div>

        <div class="pull-left">Пн-Пт: с 09:00 до 20:00&emsp;</div>

        <div class="pull-right"> <?= Html::a(Html::img('/frontend/web/img/vk.jpg', []), 'https://vk.com/club93997617') ?> </div>

        <div class="pull-left">тел. 55-00-97, +7 (950) 839-37-50</div>

        </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
