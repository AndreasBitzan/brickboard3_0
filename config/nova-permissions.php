<?php

return [
    /*
    |--------------------------------------------------------------------------
    | User model class
    |--------------------------------------------------------------------------
    */

    'user_model' => 'App\Models\User',

    /*
    |--------------------------------------------------------------------------
    | Nova User resource tool class
    |--------------------------------------------------------------------------
    */

    'user_resource' => 'App\Nova\User',

    /*
    |--------------------------------------------------------------------------
    | The group associated with the resource
    |--------------------------------------------------------------------------
    */

    'role_resource_group' => 'Other',

    /*
    |--------------------------------------------------------------------------
    | Database table names
    |--------------------------------------------------------------------------
    | When using the "HasRoles" trait from this package, we need to know which
    | table should be used to retrieve your roles. We have chosen a basic
    | default value but you may easily change it to any table you like.
    */

    'table_names' => [
        'roles' => 'roles',

        'role_permission' => 'role_permission',

        'role_user' => 'role_user',

        'users' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Permissions
    |--------------------------------------------------------------------------
    */

    'permissions' => [
        'view administration' => [
            'display_name' => 'View Backend Administration',
            'description' => 'Can View Backend Administration',
            'group' => 'Zugriff',
        ],
        'view users' => [
            'display_name' => 'View users',
            'description' => 'Can view users',
            'group' => 'User',
        ],

        'create users' => [
            'display_name' => 'Create users',
            'description' => 'Can create users',
            'group' => 'User',
        ],

        'edit users' => [
            'display_name' => 'Edit users',
            'description' => 'Can edit users',
            'group' => 'User',
        ],

        'delete users' => [
            'display_name' => 'Delete users',
            'description' => 'Can delete users',
            'group' => 'User',
        ],

        'topic moderation' => [
            'display_name' => 'Moderate Topic',
            'description' => 'Change stuff like pin, lock, etc.',
            'group' => 'Topics',
        ],

        'lock topic' => [
            'display_name' => 'Lock Topic',
            'description' => 'Lock topic',
            'group' => 'Topics',
        ],

        'pin topic' => [
            'display_name' => 'Pin Topic',
            'description' => 'Pin topic',
            'group' => 'Topics',
        ],

        'delete topic' => [
            'display_name' => 'Delete Topic',
            'description' => 'Delete topic',
            'group' => 'Topics',
        ],

        'create category' => [
            'display_name' => 'Create category',
            'description' => 'Create category',
            'group' => 'Brickfilm categories',
        ],

        'edit category' => [
            'display_name' => 'Edit category',
            'description' => 'edit category',
            'group' => 'Brickfilm categories',
        ],

        'delete category' => [
            'display_name' => 'Delete category',
            'description' => 'delete category',
            'group' => 'Brickfilm categories',
        ],

        'view reaction' => [
            'display_name' => 'View reaction',
            'description' => 'View reaction',
            'group' => 'Brickfilm reactions',
        ],

        'create reaction' => [
            'display_name' => 'Create reaction',
            'description' => 'Create reaction',
            'group' => 'Brickfilm reactions',
        ],

        'edit reaction' => [
            'display_name' => 'Edit reaction',
            'description' => 'edit reaction',
            'group' => 'Brickfilm reactions',
        ],

        'delete reaction' => [
            'display_name' => 'Delete reaction',
            'description' => 'delete reaction',
            'group' => 'Brickfilm reactions',
        ],

        'create badge' => [
            'display_name' => 'Create Badge',
            'description' => 'Create Badge',
            'group' => 'Badges',
        ],

        'update badge' => [
            'display_name' => 'Update Badge',
            'description' => 'Update Badge',
            'group' => 'Badges',
        ],

        'Delete badge' => [
            'display_name' => 'Delete Badge',
            'description' => 'Delete Badge',
            'group' => 'Badges',
        ],

        'view secret badges' => [
            'display_name' => 'View secret badges',
            'description' => 'View secret badges',
            'group' => 'Badges',
        ],

        'view roles' => [
            'display_name' => 'View roles',
            'description' => 'Can view roles',
            'group' => 'Role',
        ],

        'create roles' => [
            'display_name' => 'Create roles',
            'description' => 'Can create roles',
            'group' => 'Role',
        ],

        'edit roles' => [
            'display_name' => 'Edit roles',
            'description' => 'Can edit roles',
            'group' => 'Role',
        ],

        'delete roles' => [
            'display_name' => 'Delete roles',
            'description' => 'Can delete roles',
            'group' => 'Role',
        ],
    ],
];
