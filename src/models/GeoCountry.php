<?php

namespace m1roff\dadata\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 *
 *
 *
 * @property GeoContinent $idContinent
 */
class GeoCountry extends \m1roff\dadata\models\base\GeoCountry
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContinent()
    {
        return $this->hasOne(GeoContinent::class, ['id' => 'id_continent']);
    }

}
