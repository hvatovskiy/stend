<?php

namespace frontend\models\link;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use yii\data\Pagination;
use yii\db\Query;

/**
 * LinkSearch represents the model behind the search form about `frontend\models\link\Link`.
 */
class LinkSearch extends Link
{
    public $agencyIdagency;//
    public $articleIdarticle;//

    public $userIduserfrom;//
    public $userIduserto;//
    public $messageIdmessage;//

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['idlink', 'user_iduserfrom', 'user_iduserto', 'message_idmessage', 'agency_idagency', 'article_idarticle'], 'integer'],
            //[['userIduserfrom', 'userIduserto', 'messageIdmessage', 'articleIdarticle', 'agencyIdagency'], 'string'],
			[['linkname', 'linkdtime', 'user_iduserfrom', 'user_iduserto', 'message_idmessage', 'article_idarticle', 'agency_idagency',
                'userIduserfrom', 'userIduserto', 'messageIdmessage', 'articleIdarticle', 'agencyIdagency'], 'safe'],
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
        //РАБОЧИЙ вариант, но это CROSS JOIN
        $query = Link::find()
            ->select('link.linkname, userIduserfrom.username, userIduserto.username, messageIdmessage.msgcontent, agencyIdagency.agencyname, articleIdarticle.articletitle')
            ->from('link, user userIduserfrom, user userIduserto, agency agencyIdagency, article articleIdarticle, message messageIdmessage')
            // Жадная загрузка данных моделей agency и article для работы сортировки
            ->with(['agencyIdagency', 'articleIdarticle', 'userIduserfrom', 'userIduserto', 'messageIdmessage']);

            //->innerJoinWith(['agencyIdagency', 'articleIdarticle', 'userIduserfrom', 'userIduserto', 'messageIdmessage']);
            /*->innerJoinWith([
                'agencyIdagency' => 'agencyIdagency.idagency = link.agency_idagency',
                'articleIdarticle' => 'articleIdarticle.idarticle = link.article_idarticle',
                'userIduserfrom' => 'userIduserfrom.id = link.user_iduserfrom',
                'userIduserto' => 'userIduserto.id = link.user_iduserto',
                'messageIdmessage' => 'messageIdmessage.idmessage = link.message_idmessage',
            ], false);*/


        /*$query = (new Query())
            ->select('link.linkname, userIduserfrom.username, userIduserto.username, messageIdmessage.msgcontent, agencyIdagency.agencyname, articleIdarticle.articletitle')
            ->from('link, user userIduserfrom, user userIduserto, agency agencyIdagency, article articleIdarticle')
            // Жадная загрузка данных моделей agency и article для работы сортировки
            ->innerJoin(['agencyIdagency', 'articleIdarticle', 'userIduserfrom', 'userIduserto', 'messageIdmessage']);*/
				
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

        $dataProvider->sort->attributes['userIduserfrom'] = [
            // таблица, с которой у нас установлена связь
            'asc' => ['userIduserfrom.username' => SORT_ASC],
            'desc' => ['userIduserfrom.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['userIduserto'] = [
            // таблица, с которой у нас установлена связь
            'asc' => ['userIduserto.username' => SORT_ASC],
            'desc' => ['userIduserto.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['messageIdmessage'] = [
            // таблица, с которой у нас установлена связь
            'asc' => ['messageIdmessage.msgcontent' => SORT_ASC],
            'desc' => ['messageIdmessage.msgcontent' => SORT_DESC],
        ];

        $this->load($params);

        /*if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/

		if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
    
        //Yii::$app->VarDumper->dump($query); die();
		
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

        $query->andFilterWhere(['like', 'link.linkname', $this->linkname])
            ->andFilterWhere(['like', 'agencyIdagency.agencyname',	$this->agencyIdagency])//
            ->andFilterWhere(['like', 'article.articletitle',	$this->articleIdarticle])
            ->andFilterWhere(['like', 'userIduserfrom.username',	$this->userIduserfrom])
            ->andFilterWhere(['like', 'userIduserfrom.username',	$this->userIduserto])
            ->andFilterWhere(['like', 'messageIdmessage.msgcontent',	$this->messageIdmessage]);//

        return $dataProvider;
    }
}
