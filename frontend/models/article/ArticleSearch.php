<?php

namespace frontend\models\article;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use yii\data\Pagination;

/**
 * ArticleSearch represents the model behind the search form about `frontend\models\article\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idarticle', 'isworkurl'], 'integer'],
            [['articletitle', 'articleurl', 'description', 'newarticleurl', 'articledtime'], 'safe'],
        ];
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
        // add conditions that should always apply here
		$query = Article::find()
        ->select(['idarticle','articletitle', 'description', 'articleurl','articledtime'])
        ->from('Article');

		$countQuery = clone $query;
		
		$pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 10,
        ]);
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => $pages,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idarticle' => $this->idarticle,
            'isworkurl' => $this->isworkurl,
            'articledtime' => $this->articledtime,
        ]);

        $query->andFilterWhere(['like', 'articletitle', $this->articletitle])
            ->andFilterWhere(['like', 'articleurl', $this->articleurl])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'newarticleurl', $this->newarticleurl]);

        return $dataProvider;
    }
}
