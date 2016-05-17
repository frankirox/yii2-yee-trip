<?php

use yii\db\Migration;

class m160403_214912_add_trip_menu_links extends Migration
{

    public function safeUp()
    {
        $this->insert('{{%menu_link}}', ['id' => 'trip', 'menu_id' => 'admin-menu', 'image' => 'car', 'link' => '/trip/default/index', 'created_by' => 1, 'order' => 99]);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'trip', 'label' => 'Trips', 'language' => 'en-US']);
    }

    public function safeDown()
    {
        $this->delete('{{%menu_link}}', ['like', 'id', 'post']);
    }
}