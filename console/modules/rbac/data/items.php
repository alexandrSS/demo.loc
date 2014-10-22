<?php
return [
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
        'ruleName' => 'group',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Админ',
        'ruleName' => 'group',
        'children' => [
            'user',
        ],
    ],
    'superadmin' => [
        'type' => 1,
        'description' => 'Супер-Админ',
        'ruleName' => 'group',
        'children' => [
            'admin',
        ],
    ],
];
