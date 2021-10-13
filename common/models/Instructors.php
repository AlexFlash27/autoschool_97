<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "instructors".
 *
 * @property int $assignment_id
 */
class Instructors extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instructors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assignment_id'], 'required'],
            [['assignment_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'assignment_id' => 'Assignment ID',
            'userName' => 'Имя пользователя',
        ];
    }

    public function getAssignment()
    {
        return $this->hasOne(Authassignment::className(), ['user_id' => 'assignment_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'assignment_id']);
    }
}
