<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PublicNum;

/**
 * PublicNumSearch represents the model behind the search form of `backend\models\PublicNum`.
 */
class PublicNumSearch extends PublicNum
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['public_id', 'user_id', 'create_time'], 'integer'],
            [['public_name', 'public_brief', 'public_token'], 'safe'],
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
        $query = PublicNum::find();

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
            'public_id' => $this->public_id,
            'user_id' => $this->user_id,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'public_name', $this->public_name])
            ->andFilterWhere(['like', 'public_brief', $this->public_brief])
            ->andFilterWhere(['like', 'public_token', $this->public_token]);

        return $dataProvider;
    }
}
