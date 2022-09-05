<?php

use yii\db\Migration;

class m170907_132441_insert_into_geo_continent_table extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('geo_continent', ['code', 'name_ru', 'name_en'], [
            ['AF', 'Африка', 'Africa'],
            ['AS', 'Азия', 'Asia'],
            ['EU', 'Европа', 'Europe'],
            ['AN', 'Антарктика', 'Antarctica'],
            ['OC', 'Океания', 'Oceania'],
            ['NA', 'Северная Америка', 'North America'],
            ['SA', 'Южная Америка', 'South America'],
        ]);
        
        $this->execute('UPDATE `geo_continent` SET `created_at`=NOW(), `updated_at`=NOW() WHERE `code` IS NOT NULL');
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0');
        $this->truncateTable('geo_continent');
        $this->execute('SET FOREIGN_KEY_CHECKS=1');
    }
}
