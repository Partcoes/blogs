<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tools;

/**
 * ToolsSearch represents the model behind the search form of `frontend\models\Tools`.
 */
class ToolsSearch extends Tools
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_id'], 'integer'],
            [['file_name', 'file_desc', 'file_src', 'file_img'], 'safe'],
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
        $query = Tools::find();

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
            'file_id' => $this->file_id,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_desc', $this->file_desc])
            ->andFilterWhere(['like', 'file_src', $this->file_src])
            ->andFilterWhere(['like', 'file_img', $this->file_img]);

        return $dataProvider;
    }
}
