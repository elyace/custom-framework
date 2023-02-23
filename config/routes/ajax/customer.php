<?php

use CFM\Controller\Customer\AJAX\CustomerDeleteController;
use CFM\Controller\Customer\AJAX\CustomerListController;
use CFM\Shared\Data\Route;

return [
    Route::make(
        'ajax-customer-list',
        '/ajax/customers',
        CustomerListController::class
    ),
    Route::make(
        'ajax-customer-delete',
        '/ajax/customers/{customerId}',
        CustomerDeleteController::class,
        ['DELETE']
    ),
];