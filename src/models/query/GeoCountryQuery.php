<?php

namespace m1roff\dadata\models\query;

/**
 * This is the ActiveQuery class for [[\m1roff\dadata\models\GeoCountry]].
 *
 * @see \m1roff\dadata\models\GeoCountry
 */
class GeoCountryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \m1roff\dadata\models\GeoCountry[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \m1roff\dadata\models\GeoCountry|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
