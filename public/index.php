<?php

if( !defined('ROOT_PATH') ) define('ROOT_PATH', realpath(__DIR__ . '/../'));
if( !defined('CONFIG_PATH') ) define('CONFIG_PATH', realpath(__DIR__ . '/../config'));

use CFM\Event\KernelExceptionEvent;
use CFM\Kernel;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(realpath(__DIR__ . '/../'));
$dotenv->load();

$kernel = Kernel::getInstance();

require_once __DIR__ . '/../helper/functions.php';

$kernel->boot();