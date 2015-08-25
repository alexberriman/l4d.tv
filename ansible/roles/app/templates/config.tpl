<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname={{ app.db.main.database }}',
            'username' => '{{ app.db.main.user }}',
            'password' => '{{ app.db.main.password }}',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ],
        'db_test' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname={{ app.db.test.database }}',
            'username' => '{{ app.db.test.user }}',
            'password' => '{{ app.db.test.password }}',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ],
    ],
];