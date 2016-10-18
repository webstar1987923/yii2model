<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "videos".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $ulr_video
 * @property string $ulr_image
 * @property integer $view_count
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $is_puslish
 * @property string $created_at
 * @property string $updated_at
 */
class Videos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const IS_PUSLISH = 1;
    public static $publishList=[
                            '1'=>'Public',
                            '2'=>'Private'
                            ];
    public static function tableName()
    {
        return 'videos';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'ensureUnique' => true
            ],
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
    public function rules()
    {
        return [
            [['title', 'ulr_video', 'is_puslish'], 'required'],
            [['description'], 'string'],
            [['view_count', 'user_id', 'category_id', 'is_puslish'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'ulr_video', 'ulr_image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'ulr_video' => 'Ulr Video',
            'ulr_image' => 'Ulr Image',
            'view_count' => 'View Count',
            'user_id' => 'User ID',
            'category_id' => 'Category',
            'is_puslish' => 'Is Puslish',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['video_id' => 'id'])->where(['type' => Like::LIKE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDislikes()
    {
        return $this->hasMany(Like::className(), ['video_id' => 'id'])->where(['type' => Like::DISLIKE]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscribes()
    {
        return $this->hasMany(Subscription::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIssubscribe()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }else {
            return ( boolean )  count ( $this->getSubscribes()->where(['user_id' => \Yii::$app->user->identity->id])->one() );
        }
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['video_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

}
