<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video_source}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $priority
 * @property string $logo
 *
 * @property Video[] $videos
 */
class VideoSource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_source}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'desc'], 'required'],
            [['priority'], 'integer'],
            [['name', 'desc', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'desc' => Yii::t('app', 'Desc'),
            'priority' => Yii::t('app', 'Priority'),
            'logo' => Yii::t('app', 'Logo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::className(), ['video_source_id' => 'id']);
    }
}
