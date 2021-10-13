<?php
namespace common\models;

use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string $phone_number
 * @property string $category
 * @property string $class
 * @property string $car
 * @property string $instructor
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property date $start_educ
 * @property date $end_educ
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 'Удален';
    const STATUS_INACTIVE = 'Неактивный';
    const STATUS_ACTIVE = 'Активный';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        /*return [
            TimestampBehavior::className(),
        ];*/
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function(){ return date('Ymd');},
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],

            [['username', 'first_name', 'last_name', 'patronymic', 'phone_number', 'email', 'category', 'class', 'car', 'instructor', 'start_educ', 'end_educ'], 'trim'],

            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот адрес электронной почты уже занят.'],

            ['phone_number', 'string', 'max' => 18],
            //['phone_number', 'match', 'pattern' => '^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$^'],

            //['instructor', 'match', 'pattern' => '^[а-яА-ЯёЁ\ч]+\_[А-ЯЁ\Ч]{2}$^'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by $first_name
     *
     * @param string $first_name
     * @return static|null
     */
    public static function findByFirstname($first_name)
    {
        return static::findOne(['first_name' => $first_name, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by $last_name
     *
     * @param $last_name
     * @return static|null
     */
    public static function findByLastname($last_name)
    {
        return static::findOne(['last_name' => $last_name, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by $patronymic
     *
     * @param string $patronymic
     * @return static|null
     */
    public static function findByPatronymic($patronymic)
    {
        return static::findOne(['patronymic' => $patronymic, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by $phone_number
     *
     * @param string $phone_number
     * @return static|null
     */
    public static function findByPhonenumber($phone_number)
    {
        return static::findOne(['phone_number' => $phone_number, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     * @throws Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     * @throws Exception
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return string IdUser
     */
    public function getIdUser()
    {
        return $this->id . ' (' . $this->username . ')';
    }

    /**
     * Labels translate
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'patronymic' => 'Отчество',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'status' => 'Статус',
            'phone_number' => 'Номер телефона',
            'category' => 'Категория',
            'class' => 'Группа',
            'instructor' => 'Инструктор',
            'car' => 'Учебный автомобиль (с гос. номером)',
            'roleName' => 'Роль',
            'start_educ' => 'Начало обучения',
            'end_educ' => 'Конец обучения',
        ];
    }

    public function getAssignment()
    {
        return $this->hasOne(Authassignment::className(), ['user_id' => 'id']);
    }
}
