<?php

use CFM\Controller\Customer\CustomerDashboardController;
use CFM\Controller\Customer\CustomerListController;
use CFM\Controller\Customer\CustomerLoginController;
use CFM\Controller\HelloController;
use CFM\Shared\Data\Route;

$customerAjax = require_once __DIR__ . '/ajax/customer.php';

return [
    Route::make(
        'hello',
        '/',
        HelloController::class
    ),
    Route::make(
        'customer-list',
        '/customer-list',
        CustomerListController::class
    ),
    Route::make(
        'login',
        '/login',
        CustomerLoginController::class,
        ['GET', 'POST']
    ),
    Route::make(
        'customer-dashboard',
        '/customer-dashboard',
        CustomerDashboardController::class,
    ),
    ...$customerAjax
];