<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video_campaign}}".
 *
 * @property integer $video_id
 * @property integer $campaign_id
 *
 * @property Campaign $campaign
 * @property Video $video
 */
class VideoCampaign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_campaign}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_id', 'campaign_id'], 'required'],
            [['video_id', 'campaign_id'], 'integer'],
            [
                ['campaign_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Campaign::className(),
                'targetAttribute' => ['campaign_id' => 'id']
            ],
            [
                ['video_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Video::className(),
                'targetAttribute' => ['video_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'video_id' => Yii::t('app', 'Video ID'),
            'campaign_id' => Yii::t('app', 'Campaign ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'campaign_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['id' => 'video_id']);
    }
}
