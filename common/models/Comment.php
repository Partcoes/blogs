<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $content
 * @property int $status
 * @property int $create_time
 * @property int $userid
 * @property string $email
 * @property string $url
 * @property int $post_id
 * @property int $是否提醒 0:未提醒1：已提醒
 *
 * @property Post $post
 * @property Commentstatus $status0
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'userid', 'email', 'post_id'], 'required'],
            [['content'], 'string'],
            [['status', 'create_time', 'userid', 'post_id', 'remind'], 'integer'],
            [['email', 'url'], 'string', 'max' => 128],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Commentstatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '评论ID',
            'content' => '评论内容',
            'status' => '审核状态',
            'create_time' => '评论时间',
            'userid' => '用户',
            'email' => '用户邮箱',
            'url' => '链接',
            'post_id' => '文章',
            'remind' => '是否提醒',
            'userName'=>'用户'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Commentstatus::className(), ['id' => 'status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    public function getBeginning()
    {
        $tmpstr = strip_tags($this -> content);
        $tmplen = mb_strlen($tmpstr);
        return mb_substr($tmpstr,0,10,'utf-8').(($tmplen>10)?'...':'');
    }
    //按钮的模型层的审核代码，将状态码代表已审核
    public function check()
    {
        $this -> status = 2;
        return $this -> save()?true:false;
    }
    //查询评论待审核的数量
    public static function getPengdingCommentCount()
    {
        return self::find() -> where(['status'=>1]) -> count();
    }

    public static function getRecentComment()
    {
        $comment = Comment::find() -> where(['status' => '2']) -> orderBy('create_time desc') -> limit(3) -> all();
        return $comment;
    }
}
