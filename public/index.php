<?php
use CFM\Kernel;

require __DIR__ . '/../src/bootstrap.php';

$kernel = Kernel::getInstance();
$kernel->boot();