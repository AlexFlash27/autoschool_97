<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Instructors */

$this->title = 'Create Instructors';
$this->params['breadcrumbs'][] = ['label' => 'Instructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instructors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
