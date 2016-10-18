<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property integer $isread
 * @property string $created_at
 * @property string $updated_at
 */
class Contact extends \yii\db\ActiveRecord
{

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
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name','email', 'subject', 'message'], 'required'],
            [['message'], 'string'],
            [['isread'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name', 'subject'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'subject' => 'Subject',
            'message' => 'Message',
            'isread' => 'Isread',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
