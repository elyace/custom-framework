<?php
use CFM\Kernel;

require __DIR__ . '/../config/defines.php';
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(realpath(__DIR__ . '/../'));
$dotenv->load();

$kernel = Kernel::getInstance();

require_once __DIR__ . '/../helper/functions.php';

$kernel->boot();