<?php

namespace common\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "application".
 * @property int $created_at
 * @property int $updated_at
 * @property string $username
 * @property string $password
 * @property string $password_hash
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string $address
 * @property string $phone_number
 * @property string $email
 * @property string $category
 * @property string $place_registration
 * @property string $place_residence
 * @property string $photo
 * @property string $series_number
 * @property string $date_of_issue
 * @property string $issued_by
 * @property string $department_code
 * @property string $date_of_birth
 * @property string $birthplace
 *
 * @property string $par_series_number
 * @property string $par_first_name
 * @property string $par_last_name
 * @property string $par_patronymic
 * @property string $par_phone_number
 * @property string $par_place_registration
 * @property string $par_place_residence
 * @property string $par_date_of_issue
 * @property string $par_issued_by
 * @property string $par_department_code
 * @property string $par_date_of_birth
 * @property string $par_birthplace
 * @property string $education
 * @property string $place_work
 * @property string $position
 * @property string $series_number_aut
 * @property string $category_aut
 */
class ApplicationForm extends ActiveRecord
{
    /**
     * @var mixed|string|null
     */
    public $file;
    public $reCaptcha;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
        /*return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function(){ return date('Ymd');},
            ],
        ];*/
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'category', 'phone_number', 'email', 'place_registration', 'place_residence',
            'series_number', 'date_of_issue', 'issued_by', 'department_code', 'date_of_birth', 'birthplace',
            /*'par_series_number', 'par_date_of_issue', 'par_issued_by', 'par_department_code', 'par_date_of_birth', 'par_birthplace'*/], 'required'],

            [['username', 'password', 'password_hash', 'first_name', 'last_name', 'patronymic', 'category', 'phone_number', 'email', 'place_registration', 'place_residence',
            'series_number', 'date_of_issue', 'issued_by', 'department_code', 'date_of_birth', 'birthplace',
            'par_first_name', 'par_last_name', 'par_patronymic','par_series_number',
            'par_date_of_issue', 'par_issued_by', 'par_department_code', 'par_date_of_birth', 'par_birthplace', 'par_place_registration', 'par_place_residence',
            'education', 'place_work', 'position', 'series_number_aut', 'category_aut'], 'trim'],

            [['date_of_issue', 'date_of_birth', 'par_date_of_issue', 'par_date_of_birth'], 'safe'],

            [['username', 'password', 'password_hash',
            'first_name', 'last_name', 'patronymic', 'category', 'email',
            'birthplace', 'issued_by', 'series_number_aut',
            'par_first_name', 'par_last_name', 'par_patronymic', 'par_birthplace', 'category_aut'], 'string', 'max' => 100],

            [['place_registration', 'place_residence', 'par_place_registration', 'par_place_residence'], 'string', 'max' => 255],

            //[['first_name', 'last_name', 'patronymic'], 'match', 'pattern' => '^[а-яА-ЯёЁ\ч]+$^', 'message'=>'Допускается ввод только русских букв.'],

            //['birthplace', 'match', 'pattern' => '^[а-яА-ЯёЁ\ч\.]+$^', 'message'=>'Допускается ввод только русских букв и ".".'],

            ['phone_number', 'string', 'max' => 18],
            ['phone_number', 'match', 'pattern' => '^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$^'],

            ['par_phone_number', 'string', 'max' => 18],
            ['par_phone_number', 'match', 'pattern' => '^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$^'],

            ['email', 'email'],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот адрес электронной почты уже занят.'],

            [['series_number', 'par_series_number', 'series_number_aut'], 'string', 'max' => 12],
            [['series_number', 'par_series_number', 'series_number_aut'], 'match', 'pattern' => '^[0-9]{2}\s[0-9]{2}\s[0-9]{6}$^'],

            [['department_code', 'par_department_code'], 'string', 'max' => 7],
            [['department_code', 'par_department_code'], 'match', 'pattern' => '^[0-9]{3}\-[0-9]{3}$^'],

            //[['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif'],

            /*[['reCaptcha'], ReCaptchaValidator2::className(),
                'uncheckedMessage' => 'Please confirm that you are not a bot.'],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'username' => 'Имя пользователя',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'patronymic' => 'Отчество',
            'category' => 'Категория',
            'phone_number' => 'Номер телефона',
            'series_number' => 'Серия и номер',
            'date_of_issue' => 'Дата выдачи',
            'issued_by' => 'Кем выдан',
            'department_code' => 'Код подразделения',
            'date_of_birth' => 'Дата рождения',
            'birthplace' => 'Место рождения',

            'par_first_name' => 'Имя',
            'par_last_name' => 'Фамилия',
            'par_patronymic' => 'Отчество',
            'par_phone_number' => 'Номер телефона',
            'par_place_registration' => 'Место регистрации (по паспорту)',
            'par_place_residence' => 'Место фактического проживания',
            'par_series_number' => 'Серия и номер',
            'par_date_of_issue' => 'Дата выдачи',
            'par_issued_by' => 'Кем выдан',
            'par_department_code' => 'Код подразделения',
            'par_date_of_birth' => 'Дата рождения',
            'par_birthplace' => 'Место рождения',

            'place_registration' => 'Место регистрации (по паспорту)',
            'place_residence' => 'Место фактического проживания',
            'education' => 'Образование',
            'place_work' => 'Место работы',
            'position' => 'Занимаемая должность',
            'series_number_aut' => 'Серия и номер ВУ',
            'category_aut' => 'Категория ВУ',
            //'photo' => 'Фото',
            //'file' => 'Фото',
        ];
    }


    /*public function upload()
    {
          if ($this->validate()) {
            $this->file->saveAs('photos/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }*/
}
