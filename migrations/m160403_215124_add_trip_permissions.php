<?php

use yii\db\Migration;
use yii\db\Schema;

class m160403_215124_add_trip_permissions extends Migration
{

    public function safeUp()
    {
        $this->insert('auth_item_group', ['code' => 'tripManagement', 'name' => 'Trip Management', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => '/admin/trip/default/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/trip/default/bulk-delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/trip/default/create', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/trip/default/delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/trip/default/grid-page-size', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/trip/default/grid-sort', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/trip/default/index', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/trip/default/toggle-attribute', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/trip/default/update', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => 'viewTrips', 'type' => '2', 'description' => 'View trips', 'group_code' => 'tripManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'editTrips', 'type' => '2', 'description' => 'Edit trips', 'group_code' => 'tripManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'deleteTrips', 'type' => '2', 'description' => 'Delete trips', 'group_code' => 'tripManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'createTrips', 'type' => '2', 'description' => 'Create trips', 'group_code' => 'tripManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'fullTripsAccess', 'type' => '2', 'description' => 'Manage other users\' trips', 'group_code' => 'tripManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item_child', ['parent' => 'deleteTrips', 'child' => '/admin/trip/default/bulk-delete']);
        $this->insert('auth_item_child', ['parent' => 'createTrips', 'child' => '/admin/trip/default/create']);
        $this->insert('auth_item_child', ['parent' => 'deleteTrips', 'child' => '/admin/trip/default/delete']);
        $this->insert('auth_item_child', ['parent' => 'viewTrips', 'child' => '/admin/trip/default/grid-page-size']);
        $this->insert('auth_item_child', ['parent' => 'viewTrips', 'child' => '/admin/trip/default/grid-sort']);
        $this->insert('auth_item_child', ['parent' => 'viewTrips', 'child' => '/admin/trip/default/index']);
        $this->insert('auth_item_child', ['parent' => 'editTrips', 'child' => '/admin/trip/default/toggle-attribute']);
        $this->insert('auth_item_child', ['parent' => 'editTrips', 'child' => '/admin/trip/default/update']);

        $this->insert('auth_item_child', ['parent' => 'createTrips', 'child' => 'viewTrips']);
        $this->insert('auth_item_child', ['parent' => 'deleteTrips', 'child' => 'viewTrips']);
        $this->insert('auth_item_child', ['parent' => 'editTrips', 'child' => 'viewTrips']);

        $this->insert('auth_item_child', ['parent' => 'author', 'child' => 'createTrips']);
        $this->insert('auth_item_child', ['parent' => 'author', 'child' => 'viewTrips']);
        $this->insert('auth_item_child', ['parent' => 'author', 'child' => 'editTrips']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteTrips']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'fullTripsAccess']);
    }

    public function safeDown()
    {

        $this->delete('auth_item_child', ['parent' => 'author', 'child' => 'createTrips']);
        $this->delete('auth_item_child', ['parent' => 'author', 'child' => 'viewTrips']);
        $this->delete('auth_item_child', ['parent' => 'author', 'child' => 'editTrips']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'deleteTrips']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'fullTripsAccess']);

        $this->delete('auth_item_child', ['parent' => 'createTrips', 'child' => 'viewTrips']);
        $this->delete('auth_item_child', ['parent' => 'deleteTrips', 'child' => 'viewTrips']);
        $this->delete('auth_item_child', ['parent' => 'editTrips', 'child' => 'viewTrips']);

        $this->delete('auth_item_child', ['parent' => 'deleteTrips', 'child' => '/admin/trip/default/bulk-delete']);
        $this->delete('auth_item_child', ['parent' => 'createTrips', 'child' => '/admin/trip/default/create']);
        $this->delete('auth_item_child', ['parent' => 'deleteTrips', 'child' => '/admin/trip/default/delete']);
        $this->delete('auth_item_child', ['parent' => 'viewTrips', 'child' => '/admin/trip/default/grid-page-size']);
        $this->delete('auth_item_child', ['parent' => 'viewTrips', 'child' => '/admin/trip/default/grid-sort']);
        $this->delete('auth_item_child', ['parent' => 'viewTrips', 'child' => '/admin/trip/default/index']);
        $this->delete('auth_item_child', ['parent' => 'editTrips', 'child' => '/admin/trip/default/toggle-attribute']);
        $this->delete('auth_item_child', ['parent' => 'editTrips', 'child' => '/admin/trip/default/update']);

        $this->delete('auth_item', ['name' => 'viewTrips']);
        $this->delete('auth_item', ['name' => 'editTrips']);
        $this->delete('auth_item', ['name' => 'deleteTrips']);
        $this->delete('auth_item', ['name' => 'createTrips']);
        $this->delete('auth_item', ['name' => 'fullTripsAccess']);

        $this->delete('auth_item', ['name' => '/admin/trip/default/*']);
        $this->delete('auth_item', ['name' => '/admin/trip/default/bulk-delete']);
        $this->delete('auth_item', ['name' => '/admin/trip/default/create']);
        $this->delete('auth_item', ['name' => '/admin/trip/default/delete']);
        $this->delete('auth_item', ['name' => '/admin/trip/default/grid-page-size']);
        $this->delete('auth_item', ['name' => '/admin/trip/default/grid-sort']);
        $this->delete('auth_item', ['name' => '/admin/trip/default/index']);
        $this->delete('auth_item', ['name' => '/admin/trip/default/toggle-attribute']);
        $this->delete('auth_item', ['name' => '/admin/trip/default/update']);

        $this->delete('auth_item_group', ['code' => 'tripManagement']);
    }
}