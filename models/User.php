<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Expression;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\Follower;
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_UNACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const ADMIN = 'admin';
    const USER = 'user';
    //public $id;
    //public $username;
    //public $authKey;
    public static $arrRole = ['admin' => 'Admin', 'user' => 'User'];
    public $accessToken;
    public $repeat_password;
    //public $avatar;
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }
    /**
     * Setting table name
     */
    public static function tableName()
    {
        return 'users';
    }
    /**
     * Setting table name
     */
    public function fields() {
        $fields = parent::fields();

        // remove fields that contain sensitive information
        unset($fields['password']);

        return $fields;
    }

    public function rules()
    {
        return [
            [['user_name', 'email', 'country_id', 'state_id'], 'required'],
            [['password'], 'required', 'on' => 'register'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['repeat_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Password and re-password don't match"],
            //[['old_password', 'new_password', 're_new_password'], 'required'],
            [['email', 'user_name'], 'unique'],
            ['email', 'email'],
            ['user_name', 'string', 'min' => 3, 'max' => 255],
            [['first_name', 'last_name', 'user_name', 'email', 'password', 'date_of_birth',  'role', 'country_id', 'state_id', 'avatar'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'email' => 'E-mail',
            'country_id' => 'Country',
            'state_id' => 'State',
            'avatar' => 'Avatar',
        ];
    }
    public function beforeSave($insert) {
        if(isset($this->password)) {
            $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
            
        return parent::beforeSave($insert);
    }
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['user_name' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->role;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function getFollower()
    {
        return $this->hasMany(Follower::className(), ['following_id' => 'id']);
    }

    public function getVideos()
    {
        return $this->hasMany(Videos::className(), ['user_id' => 'id']);
    }

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    public function getIsfollow()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }else {
            return ( boolean )  count ( Follower::find()->where(['follower_id' => \Yii::$app->user->identity->id, 'following_id' => $this->id])->one() );
        } 
    }
}
