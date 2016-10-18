<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "users_messages".
 *
 * @property integer $id
 * @property integer $message_id
 * @property integer $user_id
 * @property integer $placeholder
 * @property integer $read
 */
class UserMessage extends \yii\db\ActiveRecord
{
    const INBOX = 1;
    const OUTBOX = 2;
    const DELETED = 0;
    const UNREAD = 0;
    const READ = 1;
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_id', 'user_id', 'placeholder', 'read'], 'required'],
            [['message_id', 'user_id', 'placeholder', 'read'], 'integer'],
            [['update_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message_id' => 'Message ID',
            'user_id' => 'User ID',
            'placeholder' => 'Placeholder',
            'read' => 'Read',
        ];
    }
    public function getLastMessageOut()
    {
        $message = Message::find()
                ->where(['id'=>$this->message_id])
                ->orWhere(['parent_id'=>$this->message_id])
                ->andWhere(['author_id' => Yii::$app->user->id])
                ->orderBy('id DESC')->one();
        return $message;
    }
    public function getLastMessageIn()
    {
        $message = Message::find()
                ->where(['id'=>$this->message_id])
                ->orWhere(['parent_id'=>$this->message_id])
                ->andWhere(['not', ['author_id' => Yii::$app->user->id]])
                ->orderBy('id DESC')->one();
        return $message;
    }
    public function getMessages()
    {
        $messages = Message::find()->where(['id'=>$this->message_id])->orWhere(['parent_id'=>$this->message_id])->all();
        return $messages;
    }

    public function getUserReceive()
    {
        $user_id = UserMessage::find()
                    ->where(['message_id'=>$this->message_id])
                    ->andWhere(['not', ['user_id' => $this->user_id]])
                    ->one()->user_id;
        return User::findOne($user_id);
    }
    public function getAuthor()
    {
        $messages = Message::find()
                ->where(['id'=>$this->message_id])
                ->orWhere(['parent_id'=>$this->message_id])
                ->all();
        foreach ($messages as $message) {
            if ($message->author_id!==Yii::$app->user->id) {
                $user_id = $message->author_id;
                break;
            }
        }
        return User::findOne($user_id);
    }
}
