<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\ApplicationForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?/*= $form->field($model, 'password')->passwordInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) */?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->widget(MaskedInput::className(), ['mask' => '+7 (999) 999-99-99']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList([
        'Категория «А» мотоциклы' => 'Категория «А» мотоциклы',
        'Категория «B» механика' => 'Категория «B» механика',
    ]) ?>

    <?= $form->field($model, 'place_registration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place_residence')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'series_number')->widget(MaskedInput::className(), ['mask' => '99 99 999999']) ?>

    <?= $form->field($model, 'date_of_issue')->textInput(['type' => 'date', 'max' => '2999-12-31']) ?>

    <?= $form->field($model, 'issued_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_code')->widget(MaskedInput::className(), ['mask' => '999-999']) ?>

    <?= $form->field($model, 'date_of_birth')->textInput(['type' => 'date', 'max' => '2999-12-31']) ?>

    <?= $form->field($model, 'birthplace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'education')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place_work')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'series_number_aut')->widget(MaskedInput::className(), ['mask' => '99 99 999999']) ?>

    <?= $form->field($model, 'category_aut')->dropDownList([
        'А' => 'А' ,
        'А1' => 'А1',
        'В' => 'В',
        'ВЕ' => 'ВЕ',
        'В1' => 'В1',
        'С' => 'С',
        'СЕ' => 'СЕ',
        'С1' => 'С1',
        'С1E' => 'С1E',
        'D' => 'D',
        'DE' => 'DE',
        'D1' => 'D1',
        'D1E' => 'D1E',
        'M' => 'M',
        'Tm' => 'Tm',
        'Tb' => 'Tb',
    ], ['prompt' =>'Выберите из списка']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
