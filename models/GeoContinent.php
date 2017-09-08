<?php

namespace mirkhamidov\dadata\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 *
 *
 *
 * @property GeoCountry[] $geoCountries
 */
class GeoContinent extends \mirkhamidov\dadata\models\base\GeoContinent
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCountries()
    {
        return $this->hasMany(GeoCountry::className(), ['id_continent' => 'id']);
    }

}
