<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%campaign}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $thumbnail
 *
 * @property VideoCampaign[] $videoCampaigns
 * @property Video[] $videos
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%campaign}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'thumbnail'], 'string', 'max' => 255],
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
            'thumbnail' => Yii::t('app', 'Thumbnail'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoCampaigns()
    {
        return $this->hasMany(VideoCampaign::className(), ['campaign_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::className(), ['id' => 'video_id'])
            ->viaTable('{{%video_campaign}}', ['campaign_id' => 'id']);
    }
}
