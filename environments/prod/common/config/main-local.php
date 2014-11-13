<?php
return [
    'components' => [
        'db' => require(__DIR__ . '/db-local.php')
    ],
    'params' => require(__DIR__ . '/params-local.php')
];
