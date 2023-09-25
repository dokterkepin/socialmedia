<?php
function getDatabaseConfig(): array{
    return [
        "database" =>[
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=socialmedia_login_management",
                "username" => "root",
                "password" => ""
            ],

            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=socialmedia_login_management_test",
                "username" => "root",
                "password" => ""
            ]
        ]
    ];
}