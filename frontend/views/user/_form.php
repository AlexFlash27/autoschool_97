<?php

use common\models\Instructors;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput() ?>
    <?= $form->field($model, 'last_name')->textInput() ?>
    <?= $form->field($model, 'patronymic')->textInput() ?>
    <?= $form->field($model, 'phone_number')->widget(MaskedInput::className(), ['mask' => '+7 (999) 999-99-99']) ?>
    <?php
    $items = [
        'Категория «А» мотоциклы' => 'Категория «А» мотоциклы',
        'Категория «B» механика' => 'Категория «B» механика',
    ];
    $params = [
        'prompt' => 'Выберите категорию...'
    ];
    echo $form->field($model, 'category')->dropDownList($items, $params)
    ?>
    <?/*= $form->field($model, 'instructor')->textInput() */?>
    <?= $form->field($model, 'instructor')->dropDownList(ArrayHelper::map(Instructors::find()->all(), 'user.username', 'user.username')) ?>
    <?= $form->field($model, 'class')->textInput() ?>
    <?= $form->field($model, 'car')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'start_educ')->textInput(['type' => 'date', 'max' => '2999-12-31']) ?>
    <?= $form->field($model, 'end_educ')->textInput(['type' => 'date', 'max' => '2999-12-31']) ?>
    <?= $form->field($model, 'status')->dropDownList(['Активный' => 'Активный', 'Неактивный' => 'Неактивный', 'Удален' => 'Удален']) ?>
    <?/*= $form->field($model, 'status')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
