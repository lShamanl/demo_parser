<?php

use Faker\Factory;
use lShamanl\Parser\Classes\Entity\User;

require_once __DIR__ . '/../../vendor/autoload.php';

const SEED_COUNT = 100;
const PATH_CSV = __DIR__ . '/../../import';

$faker = Factory::create();
$users = [];

for ($i = 0; $i < SEED_COUNT; $i++) {
    $year = $faker->year;
    $month = $faker->month;
    $day = $faker->dayOfMonth;

    $yearPath  = PATH_CSV . "/{$year}";
    $monthPath = PATH_CSV . "/{$year}/{$month}";
    $dayPath   = PATH_CSV . "/{$year}/{$month}/{$day}";
    $id        = $faker->numberBetween(1, 999999999);

    makeDir($yearPath);
    makeDir($monthPath);
    makeDir($dayPath);

    $user = new User(
        $id,
        $faker->name,
        $faker->url,
        $faker->phoneNumber,
        $faker->email,
    );

    $fp = fopen("$dayPath/${id}.csv", 'w');
    fputcsv($fp, $user->toArray());
    fclose($fp);
}

echo 'Seeds has created' . PHP_EOL;

function makeDir(string $path) {
    if (!file_exists($path) && !mkdir($path) && !is_dir($path)) {
        throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
    }
}
