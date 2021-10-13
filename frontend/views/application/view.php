<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ApplicationForm */

$this->title = $model->last_name .' '. $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Управление заявлениями', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="application-form-view">

    <h1> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'username',
            //'password',
            //'password_hash',
            'first_name',
            'last_name',
            'patronymic',
            'phone_number',
            'email:email',
            'category',
            'place_registration',
            'place_residence',
            'series_number',
            'date_of_issue',
            'issued_by',
            'department_code',
            'date_of_birth',
            'birthplace',
            'education',
            'place_work',
            'position',
            'series_number_aut',
            'category_aut',
            [
                'label' => 'Имя (Заказчик)',
                'attribute' => 'par_first_name',
            ],
            [
                'label' => 'Фамилия (Заказчик)',
                'attribute' => 'par_last_name',
            ],
            [
                'label' => 'Отчество (Заказчик)',
                'attribute' => 'par_patronymic',
            ],
            [
                'label' => 'Номер телефона (Заказчик)',
                'attribute' => 'par_phone_number',
            ],
            [
                'label' => 'Место регистрации [по паспорту] (Заказчик)',
                'attribute' => 'par_place_registration',
            ],
            [
                'label' => 'Место фактического проживания (Заказчик)',
                'attribute' => 'par_place_residence',
            ],
            [
                'label' => 'Серия и номер (Заказчик)',
                'attribute' => 'par_series_number',
            ],
            [
                'label' => 'Дата выдачи (Заказчик)',
                'attribute' => 'par_date_of_issue',
            ],
            [
                'label' => 'Кем выдан (Заказчик)',
                'attribute' => 'par_issued_by',
            ],
            [
                'label' => 'Код подразделения (Заказчик)',
                'attribute' => 'par_department_code',
            ],
            [
                'label' => 'Дата рождения (Заказчик)',
                'attribute' => 'par_date_of_birth',
            ],
            [
                'label' => 'Место рождения (Заказчик)',
                'attribute' => 'par_birthplace',
            ],
        ],
    ]) ?>

</div>
