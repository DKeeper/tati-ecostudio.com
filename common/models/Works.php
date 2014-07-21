<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "works".
 *
 * @property integer $id
 * @property string $name
 * @property string $page
 * @property string $description
 *
 * @property Images[] $images
 */
class Works extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'works';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'page', 'description'], 'required'],
            [['name', 'page', 'description'], 'string']
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
            'page' => Yii::t('model', 'Page'),
            'description' => Yii::t('model', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['work_id' => 'id']);
    }
}
