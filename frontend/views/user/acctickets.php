<?php

use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Билеты по ПДД';
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['/user/account?id='.Yii::$app->user->identity->id]];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="user-acctickets">

    <iframe frameborder="0" width="100%" height="900px" marginwidth="0" marginheight="0" vspace="0" hspace="0" src="//www.pdd24.com/pdd-onlain"></iframe>
    <a href="//www.pdd24.com/pdd-onlain">экзамен пдд</a>

</div>





