<?php

namespace mirkhamidov\dadata\models\query;

/**
 * This is the ActiveQuery class for [[\mirkhamidov\dadata\models\GeoContinent]].
 *
 * @see \mirkhamidov\dadata\models\GeoContinent
 */
class GeoContinentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \mirkhamidov\dadata\models\GeoContinent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \mirkhamidov\dadata\models\GeoContinent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
