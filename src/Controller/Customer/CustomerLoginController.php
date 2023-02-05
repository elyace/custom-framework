<?php

namespace CFM\Controller\Customer;

use CFM\Controller\AbstractController;
use CFM\Event\AuthenticatedCustomerEvent;
use CFM\Event\ModuleExceptionEvent;
use Module\Auth\Data\CustomerCredentials;
use Module\Auth\Exception\InvalidCustomerCredentials;
use Module\Auth\Repository\CustomerProviderRepositoryInterface;
use Module\Auth\UseCases\CustomerLogin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class CustomerLoginController extends AbstractController
{

    public function __construct(
        private readonly CustomerLogin                       $customerLogin,
        private readonly CustomerProviderRepositoryInterface $customerProviderRepository
    )
    {
    }

    public function __invoke(RequestInterface $request, array $args = []): ResponseInterface
    {
        if (null !== $this->customerProviderRepository->findCurrentCustomer()) {
            redirect('/customer-dashboard');
        }

        $credentials = $request->getParsedBody();

        if ($request->getMethod() === 'POST') {
            try {
                $auth = $this->customerLogin->execute(new CustomerCredentials(
                    $credentials['login'],
                    $credentials['password']
                ));

                dispatch(new AuthenticatedCustomerEvent($auth));
                redirect('/customer-dashboard');
            } catch (InvalidCustomerCredentials $e) {
                dispatch(new ModuleExceptionEvent($e));
            }
        }

        $view = $this->template->make('auth.login');

        return $this->successResponse($view->render());
    }
}