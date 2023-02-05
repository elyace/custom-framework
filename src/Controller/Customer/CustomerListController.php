<?php

namespace CFM\Controller\Customer;

use CFM\Controller\AbstractController;
use CFM\Shared\Attribute\Security;
use Module\Customer\UseCases\ListCustomer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

#[Security(Security::SECURE)]
final class CustomerListController extends AbstractController
{
    public function __construct(readonly private ListCustomer $listCustomer){}

    public function __invoke(RequestInterface $request, array $args = []): ResponseInterface
    {
        $customers = $this->listCustomer->execute();
        $view = $this->render('customer.list', [
            'customers' => $customers
        ]);

        return $this->successResponse($view->render());
    }
}