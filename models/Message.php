<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property string $subject
 * @property string $body
 * @property string $date
 * @property integer $author_id
 * @property integer $parent_id
 */
class Message extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'author_id', 'body'], 'required'],
            [['body'], 'string'],
            [['date'], 'safe'],
            [['author_id', 'parent_id'], 'integer'],
            [['subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'body' => 'Body',
            'date' => 'Date',
            'author_id' => 'Author ID',
            'parent_id' => 'Parent ID',
        ];
    }
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getUserReceive()
    {
        if (is_null($this->parent_id)) {
            $messageId = $this->id;
        }else $messageId = $this->parent_id;
        
        $user_id = UserMessage::find()
                    ->where(['message_id'=>$messageId])
                    ->andWhere(['not', ['user_id' => $this->author_id]])
                    ->one()->user_id;
        return User::findOne($user_id);
    }
}
