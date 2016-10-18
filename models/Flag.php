<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flags".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $ulr_video
 * @property string $title
 * @property string $comment
 * @property integer $contact
 * @property integer $status
 */
class Flag extends \yii\db\ActiveRecord
{
    const STATUS_UNACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'ulr_video', 'title', 'comment', 'full_name'], 'required'],
            ['email', 'email'],
            [['comment'], 'string'],
            [['contact', 'status'], 'integer'],
            [['full_name', 'ulr_video', 'title'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20]
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
            'phone' => 'Phone',
            'ulr_video' => 'Ulr Video',
            'title' => 'Title',
            'comment' => 'Comment',
            'contact' => 'Contact',
            'status' => 'Status',
        ];
    }
}
