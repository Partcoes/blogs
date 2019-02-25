<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 * @property int $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    public static function string2array($tags)
    {
      
        /*
            方法preg_split()，第一个参数正则表达式，第二个要转的字符串，第三个是要获取的值数量，-1，0，null都表示所有，
            第四个参数表示返回分割后非空
            此外，还有PREG_SPLIT_DELIM_CAPTURE返回正则括号中的内容，PREG_SPLIT_OFFSET_CAPTURE
         */
        return preg_split('/\s*,\s*/',trim($tags),null,PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(',',$tags);
    }
    //新增标签
    public static function addTags($tags)
    {
        if (empty($tags)) return;
        foreach ($tags as $name) {
             $aTag = Tag::find() ->  where(['name'=>$name]) -> one();
             $countTag = Tag::find() -> where(['name'=>$name]) -> count();
             if (!$countTag) {
                 $tag = new Tag();
                 $tag -> name = $name;
                 $tag -> frequency = 1;
                 $tag -> save();

             }else{
                $aTag -> frequency += 1;
                $aTag -> save();
             }
         } 
    }
    //删除标签
    public static function removeTags($tags)
    {
        if (empty($tags)) return;
        foreach ($tags as $name) {
            $aTag = Tag::find() ->  where(['name'=>$name]) -> one();
            $countTag = Tag::find() -> where(['name'=>$name]) -> count();
            if (!$countTag || $aTag -> frequency <=1) {
               $aTag -> delete();
            }else{
                $aTag -> frequency -= 1;
                $aTag -> save();
            }
        }
    }
    //修改标签
    public static function updateTags($oldTags,$newTags)
    {
        //注意一定要判断接受到的标签字符串是非空
        if (!empty($oldTags) || !empty($newTags)) {
            $oldTags = self::string2array($oldTags);
            $newTags = self::string2array($newTags);
            self::addTags(array_values(array_diff($newTags,$oldTags)));
            self::removeTags(array_values(array_diff($oldTags,$newTags))); 
        }
    }

     public static function tagWigets($limit=20)
    {
        $tag_level = 5;
        $models = Tag::find() -> orderBy('frequency desc') -> limit($limit) -> all();
        $tagtotal = Tag::find() -> limit($limit) -> count(); 
        $stepper = ceil($tagtotal/$tag_level);
        $tags = [];
        $count = 1;
        if ($tagtotal > 0) {
            foreach ($models as $model) {
                $weiget = ceil($count/$stepper) + 1;
                $tags[$model -> name] = $weiget;
                $count++;
            }
            ksort($tags);
        }
        header("content-type:text/html;charset=utf-8");
        // var_dump($tags);die;
        return $tags;

    }
}
