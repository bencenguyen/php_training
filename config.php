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
    ]
];