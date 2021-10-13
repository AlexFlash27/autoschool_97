<?php

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model common\models\ApplicationForm */
/* @var $form ActiveForm */

$this->title = 'Запись в автошколу';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-blank">

    <?=
    Modal::widget()
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Звездочками (<span style="color: red; ">*</span>) обозначены поля, обязательные для заполнения.</p>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-xs-12 col-lg-3" style="margin-right: 34px;">
            <?= $form->field($model, 'first_name')->textInput(['style'=>'width:85%']) ?>
        </div>
        <div class="col-xs-12 col-lg-3" style="margin-right: 34px;">
            <?= $form->field($model, 'last_name')->textInput(['style'=>'width:85%']) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'patronymic')->textInput(['style'=>'width:85%']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-lg-3" style="margin-right: 34px;">
            <?= $form->field($model, 'phone_number')->widget(MaskedInput::className(), ['mask' => '+7 (999) 999-99-99'])->textInput(['style'=>'width:85%']) ?>
        </div>
        <div class="col-xs-12 col-lg-3" style="margin-right: 34px;">
            <?= $form->field($model, 'email', ['options' => ['style' => 'width:85%']]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'category')->listBox([
            'Категория «А» мотоциклы' => 'Категория «А» мотоциклы',
            'Категория «B» автомобили' => 'Категория «B» автомобили',
            ],['style'=>'width:85%', 'size' => 2]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <?= $form->field($model, 'place_registration')->textarea(['style'=>'width:85%']) ?>
        </div>
        <div class ="col-lg-5">
            <?= $form->field($model, 'place_residence')->textarea(['style'=>'width:85%']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">

        <h3>Паспортные данные</h3>

        <?= $form->field($model, 'series_number')->widget(MaskedInput::className(), ['mask' => '99 99 999999'])->textInput(['style'=>'width:85%']) ?>

        <?= $form->field($model, 'date_of_issue')->textInput(['type' => 'date', 'max' => '2999-12-31', 'style'=>'width:85%']) ?>

        <?= $form->field($model, 'issued_by')->textInput(['style'=>'width:85%']) ?>

        <?= $form->field($model, 'department_code')->widget(MaskedInput::className(), ['mask' => '999-999'])->textInput(['style'=>'width:85%']) ?>

        <?= $form->field($model, 'date_of_birth')->textInput(['type' => 'date', 'max' => '2999-12-31', 'style'=>'width:85%']) ?>

        <?= $form->field($model, 'birthplace')->textInput(['style'=>'width:85%', 'value' => 'г. Ижевск']) ?>

        </div>

        <div class="col-lg-5">

        <h3>Остальные данные</h3>

        <?= $form->field($model, 'education')->textInput(['style'=>'width:85%']) ?>

        <?= $form->field($model, 'place_work')->textInput(['style'=>'width:85%']) ?>

        <?= $form->field($model, 'position')->textInput(['style'=>'width:85%']) ?>

        <h3>Водительское удостоверение <br>(если есть)</h3>

        <?= $form->field($model, 'series_number_aut')->widget(MaskedInput::className(), ['mask' => '99 99 999999'])->textInput(['style'=>'width:85%']) ?>

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
        ],['style'=>'width:85%', 'prompt' =>'Выберите из списка']) ?>

        <?php
        $password = Yii::$app->security->generateRandomString(7);
        $password_hash = Yii::$app->security->generatePasswordHash($password);
        //echo "Сгенерированный пароль:<span  style=\"color: red; font-size: xx-large; \">" .$password. "</span>";
        ?>

        <?= $form->field($model, 'password')->hiddenInput(['value' => $password])->label(false) ?>
        <?= $form->field($model, 'password_hash')->hiddenInput(['value' => $password_hash])->label(false) ?>
        <?/*= $form->field($model, 'username')->textInput(['value' => $model->last_name.'_'.$random_username])->label(false) */?>

        </div>
    </div>

    <div class="form-group">

        <?/*= $form->field($model, 'reCaptcha')->widget(ReCaptcha2::className(), [])->label(false) */?>

        <div style="color:#999;margin:1em 0">
            Отправляя нам свои данные, Вы подтверждаете, что
            <?php Modal::begin([
                //'headerOptions' => ['style' => 'display:none;'],
                'toggleButton' => [
                    'label' => 'не состоите на учете в картотеке ГИБДД (ГАИ)',
                    'tag' => 'a',
                    //'class' => 'btn btn-link',
                    //'style' => 'border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; padding-left: 0px;padding-bottom: 8px;'
                ],
            ]);
            echo '<li>ранее не имел (а) водительского удостоверения (при первоначальной подготовке);</li>
                  <li>не лишался (ась) права управления транспортными средствами;</li>
                  <li>не задерживался (ась) органами ГИБДД за управление транспортными средствами без водительского удостоверения;</li>
                  <li>не передавал (а) управление транспортным  средством лицам, находящимся в состоянии опьянения, под воздействием лекарственных препаратов, в болезненном или утомленном состоянии, а также лицам, не имеющим при себе водительского удостоверения на право управления транспортным средством данной категории.</li>
                  &emsp;Я предупрежден (а), что при сообщениие ошибочных сведений, органы ГИБДД не допустят до итоговой аттестации или откажут в выдаче водительского удостоверения. В этом случае внесенная за обучение оплата не возвращается.<br>
                  &emsp;Кроме того, я предупрежден (а), что указанные мною в настоящем заявлении данные будут переданы в органы ГИБДД.';
            Modal::end();?>
            <?/*= Html::a('не состоите на учете в картотеке ГИБДД (ГАИ)', ['']) */?>
            <br>
            и даете
            <?php Modal::begin([
                'header' => '<h4 style="text-align: center">Согласие на обработку и хранение персональных данных</h4>',
                'toggleButton' => [
                    'label' => 'согласие на обработку и хранение персональных данных.',
                    'tag' => 'a',
                    //'class' => 'btn btn-link',
                    //'style' => 'border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; padding-left: 0px;padding-bottom: 8px;'
                ],
            ]);
            echo '&emsp;Я, Ф. И. О. обучающийся в структурном подразделении автошколе «Гармония» даю свое согласие Школе Гармония:<br>
                &emsp;1. На сбор, систематизацию, накопление, хранение, уточнение (обновление, изменение), использование, распространение (в том числе передачу), обезличивание, блокировку и уничтожение, в том числе с помощью средств автоматизации, своих персональных данных:
                 <li>фамилия, имя, отчество;</li>
                 <li>год, месяц, дата рождения;</li>
                 <li>адрес;</li>
                 <li>паспортные данные;</li>
                 <li>место жительства;</li>
                 <li>сведения об образовании;</li>
                 <li>и прочие сведения, предусмотренные действующим законодательством и локальными нормативно-правовыми актами Школы №97;</li>
                &emsp;2. На передачу своих персональных данных третьим лицам в соответствии с действующим законодательством и заключаемыми договорами;<br>
                &emsp;3. На включение в общедоступные источники персональных данных следующие сведения о себе: Ф.И.О., группа, образовательная программа.<br>
                &emsp;Обработка и хранение персональных данных осуществляется в целях:
                <li>организации приема в структурное подразделение Школы Гармония автошколу «Гармония»;</li>
                <li>обеспечения учебного процесса;</li>
                <li>получения документов об образовании, а также их копий и дубликатов;</li>
                <li>подтверждения третьим лицам факта моего обучения в структурном подразделении Школы Гармония автошколе «Гармония»;</li>
                <li>в иных целях, предусмотренных законодательством.</li><br>
                &emsp;Свое согласие я даю на срок с момента обработки персональных данных до передачи их в архив.<br>
                &emsp;Я уведомлен Школой Гармония о праве на отзыв моего согласия на обработку моих персональных данных, путем подачи личного заявления на имя директора школы или иного уполномоченного им лица. В этом случае Школа Гармония прекращает обработку и хранения персональных данных и уничтожает персональные данные в срок, не превышающий семи рабочих дней с даты поступления моего отзыва.<br>
                &emsp;С действующим законодательством и локальными нормативно-правовыми актами Школы Гармония в области защиты персональных данных я ознакомлен.';
            Modal::end();?>
            <?/*= Html::a('согласие на обработку и хранение персональных данных', ['']) */?>

        </div>

        <?php
        /*if(isset($_POST['send-button'])) {
          $connection = Yii::$app->db;
          $connection->createCommand("UPDATE application SET username = CONCAT(last_name, '_', id)")->execute();
        }*/
        ?>

            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'send-button', 'id' => 'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

        <?/*= $form->field($model, 'file')->fileInput() */?><!--

        <?php /*if($model->file): */?>
            <img src="/photos/<?/*= $model->file*/?>" alt="">
        <?php /*endif; */?>

        --><?/*= Html::submitButton('Загрузить', ['class' => 'btn btn-primary', 'name' => 'photo-button']) */?>
