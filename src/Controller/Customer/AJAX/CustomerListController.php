<?php

namespace CFM\Controller\Customer\AJAX;

use CFM\Controller\AbstractController;
use CFM\Presenter\Customer\CustomerPresenterFactory;
use Module\Customer\UseCases\ListCustomer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CustomerListController extends AbstractController
{
    public function __construct(readonly private ListCustomer $listCustomer){}

    public function __invoke(RequestInterface $request, array $args = []): ResponseInterface
    {
        $customers = $this->listCustomer->execute();
        $customerPresenters = CustomerPresenterFactory::makeCollectionFromEntities($customers);

        return $this->successJsonResponse($customerPresenters);

    }
}