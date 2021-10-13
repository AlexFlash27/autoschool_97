<?php

use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AuthassignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление ролями';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authassignment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить роль', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'table-responsive',
        ],
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'headerOptions' => ['width' => '49 px'],
            ],

            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'contentOptions' => ['style' => ['width' => '133px;']],
                /*'attribute' => 'user_id',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'user_id',
                            'data' => ArrayHelper::map(User::find()->all(), 'id', 'idUser'),
                            'options' => [
                                'placeholder' => 'Выберите ID...',
                                //'multiple' => true,
                            ],
                            'pluginOptions' => ['allowClear' => true],
                        ]),*/
            ],
            [
                'attribute' => 'userName',
                'value' => 'user.username'
            ],
            [
                'attribute' => 'item_name',
                //'filter' => ['admin' => 'Администратор', 'instructor' => 'Инструктор', 'user' => 'Пользователь'],
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'item_name',
                    'data' => ['admin' => 'Администратор', 'instructor' => 'Инструктор', 'user' => 'Пользователь'],
                    'options' => [
                        'placeholder' => 'Выберите роль...',
                        //'multiple' => true,
                    ],
                    'pluginOptions' => ['allowClear' => true],
                ]),
            ],

            //['attribute' => 'created_at', 'format' => ['date', 'php:d-m-Y H:i:s']],
        ],
    ]); ?>
</div>
