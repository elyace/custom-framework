<?php

namespace CFM\Shared\Attribute;

use CFM\Event\Listener\AuthenticatedCustomerEventListener;
use CFM\Shared\Storage\KeyValueStorageInterface;

final class RouteSecurityAttributeHandler
{

    public function __construct(private readonly KeyValueStorageInterface $session)
    {
    }

    /**
     * @throws \ReflectionException
     */
    public function handle(string $controller): void
    {
        $reflectionController = new \ReflectionClass($controller);
        $attributes = $reflectionController->getAttributes(Security::class);
        $securityAttribute = current($attributes);
        if (false !== $securityAttribute) {
            /** @var Security $security */
            $security = $securityAttribute->newInstance();

            if ($security->needSecurity()) {
                $currentUser = $this->session->get(AuthenticatedCustomerEventListener::CURRENT_USER);
                if (null === $currentUser) redirect($security->redirectPath ?? '/login');
            }
        }
    }
}