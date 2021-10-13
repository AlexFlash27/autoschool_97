<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
        <?/*= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <div class="row">
        <div class = "col-lg-11" style = "margin-bottom: 5px">
            <?php $form = ActiveForm::begin(); ?>
            <?php
            if(isset($_POST['create_users-button'])) {
                $connection = Yii::$app->db;
                $connection -> createCommand("INSERT IGNORE INTO user (first_name, last_name, patronymic, phone_number, category, email, username, password_hash) 
                                            SELECT first_name, last_name, patronymic, phone_number, category, email, username, password_hash FROM application") -> execute();
            }
            ?>
            <?= Html::submitButton('Сформировать пользователей<br>(по заявлениям)', ['class' => 'btn btn-success', 'name' => 'create_users-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
        <div class = "col-lg-11" style = "margin-bottom: 5px">
            <?= Html::a('&emsp;&emsp;&nbsp;Управление ролями&emsp;&emsp;&nbsp;&nbsp;', ['/authassignment/index'], ['class'=>'btn btn-danger']) ?>
        </div>
        <div class = "col-lg-2">
            <?= Html::a('&nbsp;&nbsp;&nbsp;Регистрация пользователя&nbsp;&nbsp;&nbsp;', ['/site/signup'], ['class'=>'btn btn-primary']) ?>
        </div>
    </div>
    <br>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'style' => 'overflow: auto; word-wrap: break-word;',
            'class' => 'table-responsive',
        ],
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '66px'],
                'header'=>'Действия',
            ],

            //['class' => 'yii\grid\SerialColumn'],

            //['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i']],
            //['attribute' => 'updated_at', 'format' => ['date', 'php:d.m.Y H:i']],
            ['attribute' => 'id', 'contentOptions' => ['style' => ['width' => '60px;']]],
            /*[
                'attribute' => 'roleName',
                'contentOptions' => ['style' => ['width' => '100px;']],
                'value' => 'assignment.item_name',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'roleName',
                    'data' => ['admin' => 'Администратор', 'instructor' => 'Инструктор', 'user' => 'Пользователь'],
                    'options' => [
                        'placeholder' => 'Выберите...',
                        //'multiple' => true,
                    ],
                    'pluginOptions' => ['allowClear' => true],
                ]),
            ],*/
            [
                'attribute' => 'roleName',
                'contentOptions' => ['style' => ['width' => '100px;']],
                'value' => 'assignment.item_name',
                'filter' => ['admin' => 'Администратор', 'instructor' => 'Инструктор', 'user' => 'Пользователь'],
            ],
            'username',
            'first_name',
            'last_name',
            'patronymic',
            'phone_number',
            'email:email',
            'category',
            'instructor',
            'class',
            [
                    'attribute' => 'car',
                    'contentOptions' => ['style' => ['width' => '130px;']],
            ],
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            ['attribute' => 'start_educ', 'format' => ['date', 'd.M.Y']],
            ['attribute' => 'end_educ', 'format' => ['date', 'd.M.Y']],
            [
                'attribute' => 'status',
                'filter' => ['Активный' => 'Активный', 'Неактивный' => 'Неактивный', 'Удален' => 'Удален']
            ],
            //'verification_token',
            ],
        ]);
    ?>
</div>
