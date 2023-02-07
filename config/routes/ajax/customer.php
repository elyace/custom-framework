<?php

use CFM\Controller\Customer\AJAX\CustomerListController;
use CFM\Shared\Data\Route;

return [
    Route::make(
        'ajax-customer-list',
        '/ajax/customer-list',
        CustomerListController::class
    ),
];