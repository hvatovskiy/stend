<?php

namespace frontend\models\agencyarticle;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use yii\data\Pagination;
use frontend\models\agencyarticle\AgencyArticle;

/**
 * AgencyArticleSearch represents the model behind the search form about `frontend\models\agencyarticle\AgencyArticle`.
 */
class AgencyArticleSearch extends AgencyArticle
{
    public $agencyIdagency;//
    public $articleIdarticle;//

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idlink', 'user_iduserfrom', 'user_iduserto', 'message_idmessage', 'article_idarticle', 'agency_idagency'], 'integer'],
            [['articleIdarticle', 'agencyIdagency', 'linkname', 'linkdtime'], 'safe'],
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
        //$query = AgencyArticle::find();
        //РАБОЧИЙ вариант, но это CROSS JOIN
        $query = AgencyArticle::find()
            ->select('link.linkname, link.agency_idagency, link.article_idarticle, 
				agencyIdagency.agencyname, articleIdarticle.articletitle')
            ->from('link, agency agencyIdagency, article articleIdarticle')

            // Жадная загрузка данных моделей agency и article для работы сортировки
            ->with(['agencyIdagency', 'articleIdarticle'])
            ->where( ['link.linkname' => 'AgencyArticle']);
        // add conditions that should always apply here

        $countQuery = clone $query;

        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 10,
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages,
        ]);

        $dataProvider->sort->attributes['agencyIdagency'] = [
            // таблица, с которой у нас установлена связь
            'asc' => ['agencyIdagency.agencyname' => SORT_ASC],
            'desc' => ['agencyIdagency.agencyname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['articleIdarticle'] = [
            // таблица, с которой у нас установлена связь
            'asc' => ['articleIdarticle.articletitle' => SORT_ASC],
            'desc' => ['articleIdarticle.articletitle' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idlink' => $this->idlink,
            'linkdtime' => $this->linkdtime,
            'user_iduserfrom' => $this->user_iduserfrom,
            'user_iduserto' => $this->user_iduserto,
            'message_idmessage' => $this->message_idmessage,
            'article_idarticle' => $this->article_idarticle,
            'agency_idagency' => $this->agency_idagency,
        ]);

        $query->andFilterWhere(['like', 'linkname', $this->linkname])
            ->andFilterWhere(['like', 'agencyIdagency.agencyname',	$this->agencyIdagency])//
            ->andFilterWhere(['like', 'article.articletitle',	$this->articleIdarticle]);//

        return $dataProvider;
    }
}
