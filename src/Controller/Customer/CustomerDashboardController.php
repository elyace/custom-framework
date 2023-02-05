<?php

namespace CFM\Controller\Customer;

use CFM\Controller\AbstractController;
use CFM\Shared\Attribute\Security;
use Module\Auth\Repository\CustomerProviderRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

#[Security(Security::SECURE, '/login')]
final class CustomerDashboardController extends AbstractController
{

    public function __construct(private readonly CustomerProviderRepositoryInterface $customerProviderRepository)
    {
    }

    public function __invoke(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $customer = $this->customerProviderRepository->findCurrentCustomer();
        $view = $this->render('customer.dashboard', [
            'customer' => $customer
        ]);

        return $this->successResponse($view->render());
    }
}