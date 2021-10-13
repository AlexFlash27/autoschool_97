<?php

use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['/user/account?id='.Yii::$app->user->identity->id]];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="user-account">

    <?php

    if (Yii::$app->user->can('instructor')) {     //Инструктор
        $attributes = [
            'username',
            'first_name',
            'last_name',
            'patronymic',
            'phone_number',
            'email:email',
            'car',
        ];
    } else {     //Пользователь
        $attributes = [
            //'id',
            'username',
            'first_name',
            'last_name',
            'patronymic',
            'phone_number',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            'category',
            'class',
            'instructor',
            'car',
            ['attribute' => 'start_educ', 'format' => ['date', 'd.M.Y']],
            ['attribute' => 'end_educ', 'format' => ['date', 'd.M.Y']],
        ];
    }

    echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]);

    ?>

</div>




