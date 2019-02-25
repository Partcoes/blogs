<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;

/**
 * Signup form
 */
class ResetForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // ['username', 'trim'],
            // ['username', 'required'],
            // ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '管理员已存在'],
            // ['username', 'string', 'min' => 2, 'max' => 255],

            // ['email', 'trim'],
            // ['email', 'required'],
            // ['email', 'email'],
            // ['email', 'string', 'max' => 255],
            // ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '邮箱地址已被注册'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat','compare','compareAttribute'=>'password','message'=>'两次密码不一致'],

            // ['nickname','required'],
            // ['nickname','string','max'=>128],

            // ['profile','string'],

        ];
    }

    public function attributeLabels()
    {
         return [
                // 'id' => '用户ID',
                // 'username' => '用户名',
                // 'nickname' => '用户昵称',
                'password' => '用户密码',
                // 'email' => '用户邮箱',
                // 'profile' => '说明',
                //'auth_key' => '自动键',
                'password_repeat' => '确认密码',
                //'password_reset_token' => '重置密码token',
            ];     
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = Adminuser::findOne($id);
        $user->setPassword($this->password);
        $user -> removePasswordResetToken();
        // $user ->save();var_dump($user -> error);die;
        return $user->save() ? $user : null;
    }
}
