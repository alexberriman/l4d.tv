<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%country_region}}".
 *
 * @property string $country_id
 * @property integer $region_id
 */
class CountryRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country_region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'region_id'], 'required'],
            [['region_id'], 'integer'],
            [['country_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country_id' => Yii::t('app', 'Country ID'),
            'region_id' => Yii::t('app', 'Region ID'),
        ];
    }
}
