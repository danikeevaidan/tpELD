<?php

return [
    'enabled' => [
        'permissions-management' => true
    ],
    'permissions' => [
        'level' => \A17\Twill\Enums\PermissionLevel::LEVEL_ROLE_GROUP_ITEM,
        'modules' => ['products', 'services', 'orders', 'comments'],
    ],
];
