<?php

require __DIR__ . '/../config/defines.php';
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(realpath(__DIR__ . '/../'));
$dotenv->load();

require_once __DIR__ . '/../helper/functions.php';