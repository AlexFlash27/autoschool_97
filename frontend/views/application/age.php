<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Вам есть 18 лет?</h1>
        <br><br>

        <?= Html::a('Да', ['/application/blank'], ['class'=>'btn btn-success btn-lg', 'style'=>'margin-right: 80px']) ?>

        <?= Html::a('Нет', ['/application/blankchild'], ['class'=>'btn btn-danger btn-lg']) ?>

    </div>
</div>
