<?php
$config = require __DIR__ . '/../../config/config.php';
$dbConfig = $config['db'];

$pdo = new PDO("{$dbConfig['type']}:dbname={$dbConfig['dbname']};host={$dbConfig['host']}", $dbConfig['user'], $dbConfig['password']);

$pdo->exec(createUserTable());
$pdo->exec(createLogTable());

function createUserTable(): string
{
    return "CREATE TABLE `user` (
        `id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `url` varchar(255) NOT NULL,
        `phone` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        PRIMARY KEY (id)
    );";
}

function createLogTable(): string
{
    return "CREATE TABLE `log` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `text` text NULL,
        PRIMARY KEY (id)
    ); ";
}

echo 'Migration done!' . PHP_EOL;
