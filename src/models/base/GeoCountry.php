<?php

namespace mirkhamidov\dadata\models\base;

use Yii;

/**
 * This is the model class for table "{{%geo_country}}".
 *
 * @property int $id
 * @property int $id_continent
 * @property string $code
 * @property string $name_ru
 * @property string $name_en
 * @property string $created_at
 * @property string $updated_at
 *
 * @property GeoContinent $idContinent
 */
class GeoCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo_country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_continent', 'code', 'name_ru', 'name_en'], 'required'],
            [['id_continent'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 5],
            [['name_ru', 'name_en'], 'string', 'max' => 255],
            [['id_continent'], 'exist', 'skipOnError' => true, 'targetClass' => GeoContinent::class, 'targetAttribute' => ['id_continent' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_continent' => Yii::t('app', 'Id Continent'),
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
    public function getIdContinent()
    {
        return $this->hasOne(GeoContinent::class, ['id' => 'id_continent']);
    }

    /**
     * @inheritdoc
     * @return \mirkhamidov\dadata\models\query\GeoCountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \mirkhamidov\dadata\models\query\GeoCountryQuery(get_called_class());
    }
}
