<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Instructors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instructors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'assignment_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
