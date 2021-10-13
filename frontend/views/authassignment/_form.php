<?php

use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Authassignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authassignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?/*= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'idUser'))->label('ID (Пользователь)') */?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(User::find()->all(), 'id', 'idUser'),
    'options' => [
        'placeholder' => 'Выберите пользователя...',
        //'multiple' => true,
        ],
    'pluginOptions' => ['allowClear' => true],
    ])
    ?>

    <?/*= $form->field($model, 'userName')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'idUser'))->label('ID (Пользователь)') */?>

    <?php
    $items = ['admin' => 'Администратор', 'instructor' => 'Инструктор', 'user' => 'Пользователь'];
    echo $form->field($model, 'item_name')->dropDownList($items);
    ?>

    <?/*= $form->field($model, 'user_id')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'created_at')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
