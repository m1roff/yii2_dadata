<?php

namespace mirkhamidov\dadata\models\base;

use Yii;

/**
 * This is the model class for table "{{%geo_continent}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name_ru
 * @property string $name_en
 * @property string $created_at
 * @property string $updated_at
 *
 * @property GeoCountry[] $geoCountries
 */
class GeoContinent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_continent}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name_ru', 'name_en'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 5],
            [['name_ru', 'name_en'], 'string', 'max' => 100],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'name_en' => Yii::t('app', 'Name En'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCountries()
    {
        return $this->hasMany(GeoCountry::className(), ['id_continent' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \mirkhamidov\dadata\models\query\GeoContinentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \mirkhamidov\dadata\models\query\GeoContinentQuery(get_called_class());
    }
}
