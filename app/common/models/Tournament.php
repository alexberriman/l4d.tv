<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tournament}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $date
 * @property string $country_id
 * @property integer $winning_team_id
 * @property integer $runner_up_id
 *
 * @property Team $runnerUp
 * @property Country $country
 * @property Team $winningTeam
 */
class Tournament extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tournament}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date'], 'safe'],
            [['winning_team_id', 'runner_up_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['country_id'], 'string', 'max' => 2],
            [['runner_up_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['runner_up_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['winning_team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['winning_team_id' => 'id']],
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
            'date' => Yii::t('app', 'Date'),
            'country_id' => Yii::t('app', 'Country ID'),
            'winning_team_id' => Yii::t('app', 'Winning Team ID'),
            'runner_up_id' => Yii::t('app', 'Runner Up ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRunnerUp()
    {
        return $this->hasOne(Team::className(), ['id' => 'runner_up_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWinningTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'winning_team_id']);
    }
}
