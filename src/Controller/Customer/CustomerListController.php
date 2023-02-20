<?php

namespace CFM\Controller\Customer;

use CFM\Controller\AbstractController;
use CFM\Presenter\Customer\CustomerPresenterFactory;
use CFM\Shared\Attribute\Security;
use Module\Customer\UseCases\ListCustomer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

#[Security(Security::UNSECURE)]
final class CustomerListController extends AbstractController
{
    public function __construct(readonly private ListCustomer $listCustomer){}

    public function __invoke(RequestInterface $request, array $args = []): ResponseInterface
    {
        $customers = $this->listCustomer->execute();
        $customerPresenters = CustomerPresenterFactory::makeCollection($customers);
        $view = $this->render('customer.list', [
            'customers' => $customerPresenters
        ]);

        return $this->successResponse($view->render());
    }
}