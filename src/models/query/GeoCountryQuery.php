<?php

namespace mirkhamidov\dadata\models\query;

/**
 * This is the ActiveQuery class for [[\mirkhamidov\dadata\models\GeoCountry]].
 *
 * @see \mirkhamidov\dadata\models\GeoCountry
 */
class GeoCountryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \mirkhamidov\dadata\models\GeoCountry[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \mirkhamidov\dadata\models\GeoCountry|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
