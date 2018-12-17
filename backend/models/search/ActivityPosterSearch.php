<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ActivityPoster;

/**
 * ActivityPosterSearch represents the model behind the search form of `backend\models\ActivityPoster`.
 */
class ActivityPosterSearch extends ActivityPoster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'category_id', 'category_size', 'background_id', 'status'], 'integer'],
            [['background_image', 'activity_image', 'name', 'worknumber', 'phone', 'wechat', 'addtime', 'poster_image'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ActivityPoster::find()->orderby('id desc');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'activity_id' => $this->activity_id,
            'category_id' => $this->category_id,
            'category_size' => $this->category_size,
            'background_id' => $this->background_id,
            'addtime' => $this->addtime,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'background_image', $this->background_image])
            ->andFilterWhere(['like', 'activity_image', $this->activity_image])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'worknumber', $this->worknumber])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'wechat', $this->wechat])
            ->andFilterWhere(['like', 'poster_image', $this->poster_image]);

        return $dataProvider;
    }
}
