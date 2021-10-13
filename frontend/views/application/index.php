<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ApplicationFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class = "application-form-index">
    <!--<div class = "application-form-index table-responsive">-->

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить заявление', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'options' => [ 'style' => 'table-layout:fixed;' ],
        'options' => [
            'style' => 'overflow: auto; word-wrap: break-word;',
            'class' => 'table-responsive'
        ],
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '50px'],
                'template' => '{view} {update} {delete} {doc}',
            ],

            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'username',
            //'password',
            //'password_hash',
            //['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i']],
            ['attribute' => 'updated_at', 'format' => ['date', 'php:d.m.Y H:i']],
            'first_name',
            'last_name',
            'patronymic',
            'phone_number',
            'email',
            //'category',
            [
                'attribute' => 'category',
                'filter' => ['Категория «А» мотоциклы' => 'Категория «А» мотоциклы', 'Категория «B» механика' => 'Категория «B» механика'],
            ],
            ['attribute' => 'place_registration', 'contentOptions' => ['style' => ['width' => '112px;']]],
            'place_residence',
            'series_number',
            [
                'attribute' => 'date_of_issue',
                'format' => ['date', 'php:d.m.Y'],
                'filter' => false,
                /*'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_of_issue',
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        //'format' => 'dd.m.yyyy',
                    ],
                ]),*/
            ],
            'issued_by',
            'department_code',
            [
                'attribute' => 'date_of_birth',
                'format' => ['date', 'php:d.m.Y'],
                'filter' => false,
                /*'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_of_birth',
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        //'format' => 'dd.m.yyyy',
                    ],
                ]),*/
            ],
            'birthplace',
            'education',
            'place_work',
            'position',
            'series_number_aut',
            'category_aut',
        ],
    ]); ?>

</div>

