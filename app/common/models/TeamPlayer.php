<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%team_player}}".
 *
 * @property integer $team_id
 * @property string $player_id
 * @property integer $status
 *
 * @property Player $player
 * @property Team $team
 */
class TeamPlayer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%team_player}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_id', 'player_id'], 'required'],
            [['team_id', 'status'], 'integer'],
            [['player_id'], 'string', 'max' => 20],
            [
                ['player_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Player::className(),
                'targetAttribute' => ['player_id' => 'id']
            ],
            [
                ['team_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Team::className(),
                'targetAttribute' => ['team_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'team_id' => Yii::t('app', 'Team ID'),
            'player_id' => Yii::t('app', 'Player ID'),
            'status' => Yii::t('app', 'Status'),
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
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
    }
}
