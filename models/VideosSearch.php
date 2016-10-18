<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Videos;

/**
 * VideosSearch represents the model behind the search form about `app\models\Videos`.
 */
class VideosSearch extends Videos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'view_count', 'user_id', 'category_id', 'is_puslish'], 'integer'],
            [['title', 'slug', 'description', 'ulr_video', 'ulr_image', 'created_at', 'updated_at', 'category.name'], 'safe'],
        ];
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['category.name']);
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
        $query = Videos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['category.name'] = [
            'asc' => ['categories.name'=> SORT_ASC],
            'desc' => ['categories.name'=> SORT_DESC],
        ];

        $query->joinWith(['category']);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like','categories.name',$this->getAttribute('category.name')]);

        $query->andFilterWhere([
            'id' => $this->id,
            'view_count' => $this->view_count,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'is_puslish' => $this->is_puslish,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'ulr_video', $this->ulr_video])
            ->andFilterWhere(['like', 'ulr_image', $this->ulr_image]);

        return $dataProvider;
    }
}
