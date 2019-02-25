<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_time', 'update_time'], 'integer'],
            [['title', 'content', 'tags'], 'safe'],
            [['author_id','status'],'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    /*
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    } */

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();
        //添加应该始终适用于此的条件 
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>5,
            ],
             'sort'=>['defaultOrder'=>['update_time'=>SORT_DESC]]
        ]);
//        $dataProvider -> sort -> defaultOrder = [];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //网格过滤
        // grid filtering conditions
	#var_dump($_SERVER);DIE;
        $this -> status = strrpos($_SERVER['DOCUMENT_ROOT'],'backend') == false ? 2: $this -> status;
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'author_id' => $this->author_id,
            'title'=> $this -> title,
        ]);
        
        // $query
        //  -> join('left join','adminuser','post.author_id=adminuser.id')
        //  -> orFilterWhere(['like','nickname',$this -> author_id])
        //  -> orFilterWhere(['like','username',$this -> author_id]);
        // var_dump($this -> id);
        $id = $this -> id;
        $status = $this -> status;
        empty($id)?$query = $query -> join('left join','adminuser','post.author_id=adminuser.id'):$query;
        !empty($status)?$query = $query -> join('left join','poststatus','post.status=poststatus.position')
                ->orFilterWhere(['like','position',$this ->status]):$query;
               $query ->andFilterWhere(['like', 'title', $this->title])
               ->andFilterWhere(['like', 'content', $this->content])
               ->andFilterWhere(['like', 'tags', $this->tags])
               ->orFilterWhere(['like','nickname',$this -> author_id])
               ->orFilterWhere(['like','username',$this -> author_id]);
//        echo $query->createCommand()->rawSql;die;

        return $dataProvider;
    }
}
