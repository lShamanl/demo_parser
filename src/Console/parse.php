<?php

use lShamanl\Parser\Classes\Entity\User;

require_once __DIR__ . '/../../vendor/autoload.php';
$config = require __DIR__ . '/../../config/config.php';
$dbConfig = $config['db'];

$pdo = new PDO("{$dbConfig['type']}:dbname={$dbConfig['dbname']};host={$dbConfig['host']}", $dbConfig['user'], $dbConfig['password']);

const PATH_CSV = __DIR__ . '/../../import';

$directory = new RecursiveDirectoryIterator(PATH_CSV);
$iterator = new RecursiveIteratorIterator($directory);
$files = [];
/** @var SplFileInfo $info */
foreach ($iterator as $info) {
    if (!$info->isFile()) {
        continue;
    }

    $file = fopen($info->getRealPath(), 'r');
    $userData = fgetcsv($file);
    fclose($file);

    $user = new User(
        $userData[0],
        $userData[1],
        $userData[2],
        $userData[3],
        $userData[4],
    );

    $pdo->prepare("INSERT INTO `user` (id, name, url, phone, email) VALUES (?,?,?,?,?);")
        ->execute($user->toArray());
    $pdo->prepare("INSERT INTO `log` (text) VALUES (?);")
        ->execute(["Пользователь [{$user->getId()}]{$user->getName()} - загружен"]);
}

echo 'Parse done!' . PHP_EOL;
