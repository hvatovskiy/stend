<?php

namespace frontend\models\blog;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\blog\Blog;

use yii\data\Pagination;
/**
 * BlogSearch represents the model behind the search form about `frontend\models\blog\Blog`.
 */
class BlogSearch extends Blog
{
    public $userIduserfrom;//
    public $userIduserto;//
    public $messageIdmessage;//

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idlink', 'user_iduserfrom', 'user_iduserto', 'message_idmessage', 'article_idarticle', 'agency_idagency'], 'integer'],
            [['userIduserfrom', 'userIduserto', 'messageIdmessage', 'linkname', 'linkdtime'], 'safe'],
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
        //$query = Blog::find();

        //РАБОЧИЙ вариант, но это CROSS JOIN
        $query = Blog::find()
            ->select('link.linkname, userIduserfrom.username, userIduserto.username, messageIdmessage.msgcontent')
            ->from('link, user userIduserfrom, user userIduserto, message messageIdmessage')
            // Жадная загрузка данных моделей user и message для работы сортировки
            ->with(['userIduserfrom', 'userIduserto', 'messageIdmessage']);
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
        ]);

        $query->andFilterWhere(['like', 'linkname', $this->linkname])
            ->andFilterWhere(['like', 'userIduserfrom.username',	$this->userIduserfrom])//
            ->andFilterWhere(['like', 'userIduserfrom.username',	$this->userIduserto])//
            ->andFilterWhere(['like', 'messageIdmessage.msgcontent',	$this->messageIdmessage]);//

        return $dataProvider;
    }
}
