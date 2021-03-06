<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Instructors */

$this->title = 'Update Instructors: ' . $model->assignment_id;
$this->params['breadcrumbs'][] = ['label' => 'Instructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->assignment_id, 'url' => ['view', 'id' => $model->assignment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="instructors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
