<?php

use yii\db\Migration;

class m160403_214733_create_trip_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%trip}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer(1)->notNull()->defaultValue(2),
            'city_from' => $this->string(64)->notNull(),
            'city_to' => $this->string(64)->notNull(),
            'city_between' => $this->text(),
            'date' => $this->integer(),
            'schedule' => $this->text(),
            'price' => $this->text(),
            'vehicle' => $this->integer(1)->notNull()->defaultValue(2),
            'vehicle_model' => $this->string(127)->notNull(),
            'wifi' => $this->integer(1)->defaultValue(0),
            'fridge' => $this->integer(1)->defaultValue(0),
            'conditioner' => $this->integer(1)->defaultValue(0),
            'contacts' => $this->text(),
            'details' => $this->text(),
            'luggage' => $this->integer(1)->defaultValue(0),
            'status' => $this->integer(1)->notNull()->defaultValue(1),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('index_trip_type', '{{%trip}}', 'type');
        $this->createIndex('index_trip_vehicle', '{{%trip}}', 'vehicle');
        $this->createIndex('index_trip_luggage', '{{%trip}}', 'luggage');
        $this->createIndex('index_trip_status', '{{%trip}}', 'status');

        $this->addForeignKey('fk_trip_created_by', '{{%trip}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_trip_updated_by', '{{%trip}}', 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_trip_created_by', '{{%trip}}');
        $this->dropForeignKey('fk_trip_updated_by', '{{%trip}}');

        $this->dropTable('{{%trip}}');
    }
}