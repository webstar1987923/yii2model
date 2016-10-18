<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "followers".
 *
 * @property integer $id
 * @property integer $follower_id
 * @property integer $following_id
 * @property string $created_at
 * @property string $updated_at
 */
class Follower extends \yii\db\ActiveRecord
{
    const FOLLOW = 'follow';
    const UNFOLLOW = 'unfollow';
    /**
     * @inheritdoc
     */
    
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

    public static function tableName()
    {
        return 'followers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['follower_id', 'following_id'], 'required'],
            [['follower_id', 'following_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'follower_id' => 'Follower ID',
            'following_id' => 'Following ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'following_id']);
    }

    public function getIsfollow()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }else {
            return ( boolean )  count ( $this->getUser()->where(['follower_id' => \Yii::$app->user->identity->id])->one() );
        } 
    }
}
