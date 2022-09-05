<?php

use yii\db\Migration;

/**
 * Handles the creation of table `geo_country`.
 * Has foreign keys to the tables:
 *
 * - `geo_continent`
 */
class m170907_133251_create_geo_country_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('geo_country', [
            'id' => $this->primaryKey(),
            'id_continent' => $this->integer()->notNull(),
            'code' => $this->string(5)->notNull(),
            'name_ru' => $this->string()->notNull(),
            'name_en' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->null(),
            'updated_at' => $this->timestamp()->null(),
        ]);
    
        $this->createIndex('code', 'geo_country', 'code');

        // creates index for column `id_continent`
        $this->createIndex(
            'idx-geo_country-id_continent',
            'geo_country',
            'id_continent'
        );

        // add foreign key for table `geo_continent`
        $this->addForeignKey(
            'fk-geo_country-id_continent',
            'geo_country',
            'id_continent',
            'geo_continent',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `geo_continent`
        $this->dropForeignKey(
            'fk-geo_country-id_continent',
            'geo_country'
        );

        // drops index for column `id_continent`
        $this->dropIndex(
            'idx-geo_country-id_continent',
            'geo_country'
        );

        $this->dropTable('geo_country');
    }
}
