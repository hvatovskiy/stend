<?php

namespace frontend\models\agency;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\agency\Agency;

/**
 * AgencySearch represents the model behind the search form about `frontend\models\agency\Agency`.
 */
class AgencySearch extends Agency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idagency'], 'integer'],
            [['agencyname', 'agencywebsite'], 'safe'],
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
        $query = Agency::find();

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
            'idagency' => $this->idagency,
        ]);

        $query->andFilterWhere(['like', 'agencyname', $this->agencyname])
            ->andFilterWhere(['like', 'agencywebsite', $this->agencywebsite]);

        return $dataProvider;
    }
}
