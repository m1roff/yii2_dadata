<?php

namespace mirkhamidov\dadata\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 *
 *
 *
 * @property GeoContinent $idContinent
 */
class GeoCountry extends \mirkhamidov\dadata\models\base\GeoCountry
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
    public function getIdContinent()
    {
        return $this->hasOne(GeoContinent::className(), ['id' => 'id_continent']);
    }

}
