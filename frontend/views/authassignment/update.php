<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Authassignment */

$this->title = 'Изменить: ' . $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/user/index']];
$this->params['breadcrumbs'][] = ['label' => 'Управление ролями', 'url' => ['/authassignment/index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_name, 'url' => ['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="authassignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
