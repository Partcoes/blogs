<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tools".
 *
 * @property string $file_id 文件id
 * @property string $file_name
 * @property string $file_desc
 * @property string $file_src
 * @property string $file_img
 */
class Tools extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name', 'file_src'], 'required'],
            [['file_desc'], 'string'],
            [['file_name'], 'string', 'max' => 60],
            [['file_src', 'file_img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'file_name' => 'File Name',
            'file_desc' => 'File Desc',
            'file_src' => 'File Src',
            'file_img' => 'File Img',
        ];
    }
    public function getUrl()
    {
        if(isset($_SESSION['__id'])) {
            return Yii::$app->urlManager->createUrl([
                'tools/detail',
                'id' => $this->file_id,
            ]);
        }else{
            return Yii::$app->urlManager->createUrl([
                'site/login',
                'id' => $this->file_id,
            ]);
        }
    }
}
