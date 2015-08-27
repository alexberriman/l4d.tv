<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video_caster}}".
 *
 * @property integer $video_id
 * @property integer $caster_id
 *
 * @property Caster $caster
 * @property Video $video
 */
class VideoCaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_caster}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_id', 'caster_id'], 'required'],
            [['video_id', 'caster_id'], 'integer'],
            [['caster_id'], 'exist', 'skipOnError' => true, 'targetClass' => Caster::className(), 'targetAttribute' => ['caster_id' => 'id']],
            [['video_id'], 'exist', 'skipOnError' => true, 'targetClass' => Video::className(), 'targetAttribute' => ['video_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'video_id' => Yii::t('app', 'Video ID'),
            'caster_id' => Yii::t('app', 'Caster ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaster()
    {
        return $this->hasOne(Caster::className(), ['id' => 'caster_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['id' => 'video_id']);
    }
}
