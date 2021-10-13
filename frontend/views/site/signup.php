<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model SignupForm */

use frontend\models\SignupForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Звездочками (<span style="color: red; ">*</span>) обозначены поля, обязательные для заполнения.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'first_name')->textInput() ?>

                <?= $form->field($model, 'last_name')->textInput() ?>

                <?= $form->field($model, 'patronymic')->textInput() ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Фамилия'. '_' .mt_rand(100, 999).' (Ученик); Фамилия_ИО (Сотрудник)']) ?>

                <?= $form->field($model, 'phone_number')->widget(MaskedInput::className(), ['mask' => '+7 (999) 999-99-99']) ?>

                <?/*= $form->field($model, 'username')->textInput(['value' => 'Фамилия'. '_' .mt_rand(100, 999)]) */?>

                <?/*= $form->field($model, 'username')->hiddenInput()->label(false) */?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Зарегистрировать', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
