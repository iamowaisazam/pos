<?php
namespace App\Enums;

class Permission
{

CONST DATA = array(
        'users' => [
            'dashboard',
            'list',
            'create',
            'edit',
            'view',
            'delete',
            'profile-view',
            'profile-update',
        ],
        'roles' => [
            'list',
            'create',
            'edit',
            'view',
            'delete',
        ],
        'customers' => [
            'list',
            'create',
            'edit',
            'view',
            'delete',
            'statement',
        ],
        'vendors' => [
            'list',
            'create',
            'edit',
            'view',
            'delete',
        ],
        'jobs-consignment' => [
            'list',
            'create',
            'edit',
            'view',
            'print',
            'delete',
        ],
        'delivery-challans' => [
            'list',
            'create',
            'print',
            'delete',
        ],
        'delivery-intimation' => [
            'list',
            'create',
            'print',
            'delete',
        ],
        'settings' => [
            'menu',
            'edit',
            'view',
        ],
    );

}