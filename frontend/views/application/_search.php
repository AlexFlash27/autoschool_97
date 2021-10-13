<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ApplicationFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'username') ?>

    <?php //echo $form->field($model, 'password') ?>

    <?php //echo $form->field($model, 'password_hash') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'patronymic') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'place_registration') ?>

    <?= $form->field($model, 'place_residence') ?>

    <?= $form->field($model, 'series_number') ?>

    <?= $form->field($model, 'date_of_issue') ?>

    <?= $form->field($model, 'issued_by') ?>

    <?= $form->field($model, 'department_code') ?>

    <?= $form->field($model, 'date_of_birth') ?>

    <?= $form->field($model, 'birthplace') ?>

    <?= $form->field($model, 'education') ?>

    <?= $form->field($model, 'place_work') ?>

    <?= $form->field($model, 'position') ?>

    <?= $form->field($model, 'series_number_aut') ?>

    <?= $form->field($model, 'category_aut') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
