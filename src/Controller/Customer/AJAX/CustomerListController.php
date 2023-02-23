<?php

namespace CFM\Controller\Customer\AJAX;

use CFM\Controller\AbstractController;
use CFM\Presenter\Customer\CustomerPresenterFactory;
use Module\Customer\UseCases\ListCustomer;
use Nyholm\Psr7\ServerRequest;
use Persistence\Paginator\PageUrlHelper;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CustomerListController extends AbstractController
{

    use PageUrlHelper;

    private const AJAX_CUSTOMER_LIST = 'ajax-customer-list';

    public function __construct(readonly private ListCustomer $listCustomer){}

    /**
     * @param ServerRequest $request
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, array $args = []): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $page = $queryParams['page'] ?? 1;
        $customers = $this->listCustomer->execute(
            $page,
            $queryParams['per_page'] ?? 10,
        );

        $route = getRoute(self::AJAX_CUSTOMER_LIST);
        $this->setCurrentPage($page)
            ->setRoute($route->path)
            ->setPageCount($customers->pageCount);

        $customerPresenters = CustomerPresenterFactory::makePaginatedCollection(
            $customers,
            $page,
            $this->getLastPageUrl(),
            $this->getNextPageUrl(),
            $this->getPrevPageUrl()
        );

        $this->setCacheAge(60*60*24);

        return $this->successJsonResponse($customerPresenters->present());
    }
}