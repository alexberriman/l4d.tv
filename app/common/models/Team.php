<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%team}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property integer $added_by_id
 *
 * @property User $addedBy
 * @property TeamPlayer[] $teamPlayers
 * @property Player[] $players
 * @property Tournament[] $tournaments
 * @property Tournament[] $tournaments0
 * @property VideoTeam[] $videoTeams
 * @property Video[] $videos
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%team}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'added_by_id'], 'required'],
            [['added_by_id'], 'integer'],
            [['name', 'logo'], 'string', 'max' => 255],
            [
                ['added_by_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['added_by_id' => 'id']
            ],
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
            'logo' => Yii::t('app', 'Logo'),
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
    public function getTeamPlayers()
    {
        return $this->hasMany(TeamPlayer::className(), ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Player::className(), ['id' => 'player_id'])
            ->viaTable('{{%team_player}}', ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournaments()
    {
        return $this->hasMany(Tournament::className(), ['runner_up_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournaments0()
    {
        return $this->hasMany(Tournament::className(), ['winning_team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoTeams()
    {
        return $this->hasMany(VideoTeam::className(), ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::className(), ['id' => 'video_id'])
            ->viaTable('{{%video_team}}', ['team_id' => 'id']);
    }
}
