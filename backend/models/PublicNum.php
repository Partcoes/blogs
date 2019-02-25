<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "public_num".
 *
 * @property int $public_id
 * @property string $public_name
 * @property string $public_brief
 * @property string $public_token
 * @property int $user_id
 * @property int $create_time
 */
class PublicNum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public_num';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['public_name', 'public_brief', 'public_token', 'user_id', 'create_time','appid','secret'], 'required'],
            [['user_id', 'create_time'], 'integer'],
            [['public_name'], 'string', 'max' => 30],
            [['public_brief'], 'string', 'max' => 60],
            [['public_token'], 'string', 'max' => 120],
            [['public_token'],'match','pattern'=>'/^[a-zA-Z0-9]{3,30}$/','message'=>'token为3-30位数字和字母组合'],
            [['appid'],'match','pattern'=>'/^[a-zA-Z0-9]{18,}$/','message'=>'appid为18位数字字母组合'],
            [['secret'],'match','pattern'=>'/^[a-zA-Z0-9]{32}$/','message'=>'secret为32位数字字母组合'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'public_id' => '公众号ID',
            'public_name' => '公众号名称',
            'public_brief' => '公众号简介',
            'public_token' => '公众号token',
            'user_id' => '用户ID',
            'create_time' => '创建时间',
            'serverurl' => '服务器地址',
            'appid' => '应用id(appid)',
            'secret' => '开发者秘钥(secret)',
        ];
    }
    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes[] = 'serverurl';
        return $attributes;
    }

    public function getUsername()
    {
        return $this -> hasOne(User::className(),['id'=>'user_id']);
    }
}
