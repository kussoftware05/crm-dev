<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use backend\exceptions\ModelValidationException;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

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
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['username'], 'string', 'max' => 100],
            [['password_hash', 'auth_key', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['first_name', 'last_name'] , 'safe']
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
           'password_hash' => 'Password',
           'first_name' => 'First Name',
           'last_name' => 'Last Name',
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
     * Finds user by username and type
     * 
     * @param string $username
     * @param string $type
     * @return static|null
     */
    public static function findByUserNameAndType($username,$type='ADMIN')
    {
        return static::findOne(
                                [
                                    'username' => $username,
                                    'type' => $type, 
                                    'status' => self::STATUS_ACTIVE
                                ]
                            );
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
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            if ($this->isNewRecord) 
                $this->generateAuthKey();
            return true;
        }
        return false;
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
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
     * create new user
     * 
     * @param string $username
     * @param string $password
     * @param string $email
     * @return bool
     * 
     * @throws ModelValidationException
     */
    public function createNewUser($username, $password, $email)
    {
        $new_user = $this;
        $new_user->username = $username;
        $new_user->password_hash = $password;
        $new_user->email = $email;
        if(!$new_user->validate())
            throw new ModelValidationException('validation error');
        $this->setPassword($password);
        $this->insert(false);
        return $this;
    }

    /**
     * get user full name
     */
    public function getUserFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * get all user with names
     * 
     * @return array 
     */
    public static function getAllUserWithNames()
    {
        $users = self::find()->all();
        $name_with_pk = [];
        if(empty($users))
            return $name_with_pk;
        foreach($users as $user)
        {
            $name_with_pk[$user->id] = $user->getUserFullName();
        }
        return $name_with_pk;
    }

    /**
     * change email address
     * 
     * @param string $username
     * @param string $email
     * @return bool
     */
    public static function changeAdminEmailAddress($username, $email)
    {
        if(empty($email) || !isset($email)) 
            return false;
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) 
            return false;
        $model = self::findByUsername($username);
        $model->email = $email;
        return $model->update();
    }

    /**
     * change user password
     * 
     * @param string $current_password
     * @param string $new_password
     * @param string $retyped_password
     * @return bool
     */
    public function changeUserPassword($current_password, $new_password, $retyped_password )
    {
        if($new_password !== $retyped_password) 
            return false;
        $user = self::findByUsername(Yii::$app->user->identity->username);
        if(!$user || !$user->validatePassword($current_password)) 
            return false;
        $user->password = Yii::$app->security->generatePasswordHash($new_password);
        return $user->update();
    }
}
