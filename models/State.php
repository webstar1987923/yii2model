<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "osn_states".
 *
 * @property string $id
 * @property string $country_id
 * @property string $name
 * @property string $timezone
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'osn_states';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id'], 'integer'],
            [['name', 'timezone'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'name' => 'Name',
            'timezone' => 'Timezone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    public function getUser()
    {
        return $this->hasMany(User::className(), ['state_id' => 'id']);
    }
}
