<?php

use yii\db\Migration;

/**
 * Handles the creation of table `geo_continent`.
 */
class m170907_122255_create_geo_continent_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('geo_continent', [
            'id' => $this->primaryKey(),
            'code' => $this->string(5)->notNull(),
            'name_ru' => $this->string(100)->notNull(),
            'name_en' => $this->string(100)->notNull(),
            'created_at' => $this->timestamp()->null(),
            'updated_at' => $this->timestamp()->null(),
        ]);
        
        $this->createIndex('code', 'geo_continent', 'code', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('geo_continent');
    }
}
