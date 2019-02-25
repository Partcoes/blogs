<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comment;

/**
 * CommentSearch represents the model behind the search form of `common\models\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'create_time', 'userid', 'post_id', 'remind'], 'integer'],
            [['content', 'email', 'url','userName'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(),['userName']);
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
        $query = Comment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>5],
            // 'sort'=>['defaultOrder'=>['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'comment.id' => $this->id,
            'comment.status' => $this->status,
            'comment.create_time' => $this->create_time,
            'comment.userid' => $this->userid,
            'comment.post_id' => $this->post_id,
            'comment.remind' => $this->remind,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'url', $this->url]);
            $query -> join('INNER join','user','comment.userid=user.id'); 
            $query -> andFilterWhere(['like','user.username',$this -> userName]);
        $dataProvider -> sort -> attributes['userName'] = [
            'asc'=>['user.username'=>SORT_ASC],
            'desc'=>['user.username'=>SORT_DESC]
        ];
        $dataProvider -> sort -> defaultOrder = [
            'status'=>SORT_ASC,
            'id'=>SORT_DESC,
        ];
        return $dataProvider;
    }
}
