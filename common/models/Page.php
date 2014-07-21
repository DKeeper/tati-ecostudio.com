<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $content
 * @property string $script
 * @property integer $status
 * @property integer $output_order
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title', 'content', 'status'], 'required'],
            [['name', 'title', 'content', 'script'], 'string'],
            ['script', 'default', 'value' => null],
            [['status', 'output_order'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'name' => Yii::t('model', 'Name'),
            'title' => Yii::t('model', 'Title'),
            'content' => Yii::t('model', 'Content'),
            'script' => Yii::t('model', 'Script'),
            'status' => Yii::t('model', 'Status'),
            'output_order' => Yii::t('model', 'Output Order'),
        ];
    }

    public static function getActivePageNames(){
        return (new \yii\db\Query())
            ->select('name')
            ->from(self::tableName())
            ->where(['status'=>1])
            ->all();
    }
}
