<?php

use yeesoft\db\PermissionsMigration;

class m160403_215124_add_trip_permissions extends PermissionsMigration
{

    public function beforeUp()
    {
        $this->addPermissionsGroup('tripManagement', 'Trip Management');
    }

    public function afterDown()
    {
        $this->deletePermissionsGroup('tripManagement');
    }

    public function getPermissions()
    {
        return [
            'tripManagement' => [
                'links' => [
                    '/admin/trip/*',
                    '/admin/trip/default/*',
                ],
                'viewTrips' => [
                    'title' => 'View Trips',
                    'roles' => [self::ROLE_AUTHOR],
                    'links' => [
                        '/admin/trip/default/index',
                        '/admin/trip/default/grid-sort',
                        '/admin/trip/default/grid-page-size',
                    ],
                ],
                'editTrips' => [
                    'title' => 'Edit Trips',
                    'roles' => [self::ROLE_AUTHOR],
                    'childs' => ['viewTrips'],
                    'links' => [
                        '/admin/trip/default/update',
                    ],
                ],
                'createTrips' => [
                    'title' => 'Create Trips',
                    'roles' => [self::ROLE_AUTHOR],
                    'childs' => ['viewTrips'],
                    'links' => [
                        '/admin/trip/default/create',
                    ],
                ],
                'deleteTrips' => [
                    'title' => 'Delete Trips',
                    'roles' => [self::ROLE_ADMIN],
                    'childs' => ['viewTrips'],
                    'links' => [
                        '/admin/trip/default/delete',
                        '/admin/trip/default/bulk-delete',
                    ],
                ],
                'fullTripAccess' => [
                    'title' => 'Full Trip Access',
                    'roles' => [self::ROLE_ADMIN],
                ],
            ],
        ];
    }

}
