<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Articles;

/**
 * ArticlesSearch represents the model behind the search form of `common\models\Articles`.
 */
class ArticlesSearch extends Articles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'catalog_id', 'view_count', 'last_update_time', 'sort_desc', 'create_time'], 'integer'],
            [['title', 'title_second', 'title_alias', 'author', 'template', 'intro', 'seo_title', 'seo_description', 'seo_keywords', 'content', 'copy_from', 'copy_url', 'redirect_url', 'tags', 'commend', 'top_line', 'status_is'], 'safe'],
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
        $query = Articles::find();

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
            'catalog_id' => $this->catalog_id,
            'view_count' => $this->view_count,
            'last_update_time' => $this->last_update_time,
            'sort_desc' => $this->sort_desc,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_second', $this->title_second])
            ->andFilterWhere(['like', 'title_alias', $this->title_alias])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'copy_from', $this->copy_from])
            ->andFilterWhere(['like', 'copy_url', $this->copy_url])
            ->andFilterWhere(['like', 'redirect_url', $this->redirect_url])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'commend', $this->commend])
            ->andFilterWhere(['like', 'top_line', $this->top_line])
            ->andFilterWhere(['like', 'status_is', $this->status_is]);

        return $dataProvider;
    }
}
