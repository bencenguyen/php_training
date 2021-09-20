<?php

return [
    'db_host' => 'localhost',
    'db_name' => 'training',
    'db_user' => 'root',
    'db_pass' => '',
    "session" => [
        "driver" => "file",
        "config" => [
            "folder" => realpath(__DIR__) . "/storage/sessions"
        ]
    ],
    
    "mail" => [
        "username" => '2df01438431ae5',
        "password" => 'faa85ccb16029e',
        "host"     => 'smtp.mailtrap.io',
        "port"     => 2525
    ]
];
