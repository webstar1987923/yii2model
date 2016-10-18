<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state_id', 'country_id', 'active'], 'integer'],
            [['first_name', 'last_name', 'user_name', 'email', 'token', 'password', 'date_of_birth', 'role', 'avatar', 'created_at', 'updated_at', 'state.name', 'country.country'], 'safe'],
        ];
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['state.name', 'country.country']);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['state.name'] = [
            'asc' => ['osn_states.name'=> SORT_ASC],
            'desc' => ['osn_states.name'=> SORT_DESC],
        ];

        $dataProvider->sort->attributes['country.country'] = [
            'asc' => ['osn_countries.country'=> SORT_ASC],
            'desc' => ['osn_countries.country'=> SORT_DESC],
        ];

        $query->joinWith(['country', 'state']);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->andFilterWhere(['like','osn_states.name',$this->getAttribute('state.name')]);

        $query->andFilterWhere(['like','osn_countries.country',$this->getAttribute('country.country')]);

        $query->andFilterWhere([
            'id' => $this->id,
            'date_of_birth' => $this->date_of_birth,
            'state_id' => $this->state_id,
            'country_id' => $this->country_id,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'avatar', $this->avatar]);

        return $dataProvider;
    }
}
