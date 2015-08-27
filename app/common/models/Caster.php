<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%caster}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property VideoCaster[] $videoCasters
 * @property Video[] $videos
 */
class Caster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%caster}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoCasters()
    {
        return $this->hasMany(VideoCaster::className(), ['caster_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::className(), ['id' => 'video_id'])->viaTable('{{%video_caster}}', ['caster_id' => 'id']);
    }
}
