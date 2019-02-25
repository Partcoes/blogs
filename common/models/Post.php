<?php

namespace common\models;
use yii\helpers\Html;
use backend\models\Tags;
use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property int $status
 * @property int $create_time
 * @property int $update_time
 * @property int $author_id
 *
 * @property Comment[] $comments
 * @property Adminuser $author
 * @property Poststatus $status0
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    private $_oldTags;

    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status', 'author_id'], 'required'],
            [['content', 'tags'], 'string'],
            [['create_time', 'update_time'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Poststatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '文章ID',
            'title' => '文章标题',
            'content' => '文章内容',
            'tags' => '标签',
            'status' => '文章状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
            'author_id' => '作者',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    public function getActiveComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id'])
        ->where('status=:status',[':status'=>2])->orderBy('id DESC');
    }    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Poststatus::className(), ['id' => 'status']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this -> create_time = time();
                $this -> update_time = time();
                // $this -> author_id = Yii::$app -> user -> identity -> id;             
            }else{
                $this -> update_time = time();
                // $this -> author_id = Yii::$app -> user -> identity -> id;             
            }
            return true;
        }else{
            return false;
        }
    }

    public function afterFind()
    {
    	//先存放原先的标签，当出现修改时，会先查询这条记录，查询后便会执行该操作
    	parent::afterFind();
    	$this -> _oldTags = $this -> tags;
    	
    }
    //在新增或修改标签的时候文章保存之后调用该方法
    public function afterSave($insert,$changedAttributes)
    {
    	parent::afterSave($insert,$changedAttributes);
    	// var_dump($this -> _oldTags,$this->tags);die;
    	Tag::updateTags($this -> _oldTags,$this -> tags);
    }
    //在删除整篇文章后，该文章所拥有的所有标签，出现的数量将进行减一操作
    public function afterDelete()
    {
    	//继承父类删除之后的操作，
    	parent::afterDelete();
    	Tag::updateTags($this -> tags,'');
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl([
            'post/detail',
            'id' => $this->id,
            'title' => $this->title
        ]);
//        if(isset($_SESSION['__id'])) {
//
//        }elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') != false){
//            return Yii::$app->urlManager->createUrl([
//                'site/login',
//                'id' => $this->id,
//                'title' => $this->title
//            ]);
//        }else{
//            return Yii::$app->urlManager->createUrl([
//                'post/detail',
//                'id' => $this->id,
//                'title' => $this->title
//            ]);
//        }
    }

    public function getBeginning($len = 200)
    {
        $str = strip_tags($this -> content);
        $strlen = mb_strlen($str);
        $substr = mb_substr($str,0,$len,'utf-8');
        // var_dump($strlen);die;
        $substr = ($strlen > $len) ? $substr . "·····":$substr;
        return $substr;
    }

    public function getTagLinks()
    {
        $links = [];
        foreach (Tag::string2array($this -> tags) as $tag) {
           $links[] = Html::a(Html::encode($tag),['post/index','postSearch[tag]'=>$tag]);
        }
        return $links;
    }//看错了，这个是标签的链接
    public function getCommentCount()
    {
        $comment = Comment::find() -> where(['post_id'=>$this -> id,'status'=>2]) -> count();
        return $comment;
    }


   
}
