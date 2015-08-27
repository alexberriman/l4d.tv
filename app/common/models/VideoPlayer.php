<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video_player}}".
 *
 * @property integer $video_id
 * @property string $player_id
 *
 * @property Player $player
 * @property Video $video
 */
class VideoPlayer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_player}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_id', 'player_id'], 'required'],
            [['video_id'], 'integer'],
            [['player_id'], 'string', 'max' => 20],
            [
                ['player_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Player::className(),
                'targetAttribute' => ['player_id' => 'id']
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
            'player_id' => Yii::t('app', 'Player ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(Player::className(), ['id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['id' => 'video_id']);
    }
}
