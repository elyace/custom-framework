<?php

namespace CFM\Controller\Customer\AJAX;

use CFM\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\ServerRequest;
use Persistence\Entity\Customer\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CustomerDeleteController extends AbstractController
{

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param ServerRequest $request
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $customerId = $args['customerId'] ?? 0;
        $customer = $this->entityManager->getRepository(Customer::class)
            ->findOneBy(['id' => $customerId]);

        if( null !== $customer )
        {
            $this->entityManager->remove($customer);
            $this->entityManager->flush();
        }

        if( null === $customer )
        {
            return $this->unSuccessJsonResponse(["Customer with id $customerId was not found"]);
        }

        return $this->successJsonResponse([]);
    }
}