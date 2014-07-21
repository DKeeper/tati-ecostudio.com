<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property string $description
 * @property integer $work_id
 * @property string $link
 *
 * @property Works $work
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'work_id', 'link'], 'required'],
            [['description', 'link'], 'string'],
            [['work_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'description' => Yii::t('model', 'Description'),
            'work_id' => Yii::t('model', 'Work ID'),
            'link' => Yii::t('model', 'Link'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWork()
    {
        return $this->hasOne(Works::className(), ['id' => 'work_id']);
    }
}
