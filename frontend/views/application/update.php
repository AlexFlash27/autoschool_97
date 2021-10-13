<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ApplicationForm */

$this->title = 'Изменить заявление: ' . $model->last_name .' '. $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Управление заявлениями', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->last_name .' '. $model->first_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="application-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
