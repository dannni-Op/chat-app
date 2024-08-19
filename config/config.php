<?php

function getDatabaseConfig(): array {
    return ["config" => [
            "dev" => [
                "db" => "mysql",
                "dbhost" => "localhost",
                "dbname" => "chat_db",
                "dbuser" => "root",
                "dbpass" => "root"
            ], "prod" => [
                "db" => "mysql",
                "dbhost" => "localhost",
                "dbname" => "chat_db",
                "dbusername" => "root",
                "dbpass" => "root"
            ]
        ]
    ];
}