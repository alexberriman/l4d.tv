<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property integer $id
 * @property integer $video_source_id
 * @property string $title
 * @property string $description
 * @property string $key
 * @property string $thumbnail
 * @property string $date_added
 * @property string $date_created
 * @property integer $added_by_id
 *
 * @property User $addedBy
 * @property VideoSource $videoSource
 * @property VideoCampaign[] $videoCampaigns
 * @property Campaign[] $campaigns
 * @property VideoCaster[] $videoCasters
 * @property Caster[] $casters
 * @property VideoPlayer[] $videoPlayers
 * @property Player[] $players
 * @property VideoTeam[] $videoTeams
 * @property Team[] $teams
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_source_id', 'title', 'key', 'date_added'], 'required'],
            [['video_source_id', 'added_by_id'], 'integer'],
            [['description'], 'string'],
            [['date_added', 'date_created'], 'safe'],
            [['title', 'key', 'thumbnail'], 'string', 'max' => 255],
            [['added_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by_id' => 'id']],
            [['video_source_id'], 'exist', 'skipOnError' => true, 'targetClass' => VideoSource::className(), 'targetAttribute' => ['video_source_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'video_source_id' => Yii::t('app', 'Video Source ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'key' => Yii::t('app', 'Key'),
            'thumbnail' => Yii::t('app', 'Thumbnail'),
            'date_added' => Yii::t('app', 'Date Added'),
            'date_created' => Yii::t('app', 'Date Created'),
            'added_by_id' => Yii::t('app', 'Added By ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoSource()
    {
        return $this->hasOne(VideoSource::className(), ['id' => 'video_source_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoCampaigns()
    {
        return $this->hasMany(VideoCampaign::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::className(), ['id' => 'campaign_id'])->viaTable('{{%video_campaign}}', ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoCasters()
    {
        return $this->hasMany(VideoCaster::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCasters()
    {
        return $this->hasMany(Caster::className(), ['id' => 'caster_id'])->viaTable('{{%video_caster}}', ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoPlayers()
    {
        return $this->hasMany(VideoPlayer::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Player::className(), ['id' => 'player_id'])->viaTable('{{%video_player}}', ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoTeams()
    {
        return $this->hasMany(VideoTeam::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['id' => 'team_id'])->viaTable('{{%video_team}}', ['video_id' => 'id']);
    }
}
