<?php

use CFM\Shared\Event\EventManager;
use CFM\Shared\Event\EventManagerInterface;
use CFM\Shared\Storage\FlashMessage\FlashMessageManager;
use CFM\Shared\Storage\FlashMessage\FlashMessageManagerInterface;
use CFM\Shared\Storage\KeyValueStorageInterface;
use CFM\Shared\Storage\SessionStorage;
use CFM\Shared\Vite\AssetManager;
use CFM\Shared\Vite\AssetManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

$repositories = require_once __DIR__ . '/repositories/customer.php';
$modules = require_once __DIR__ . '/repositories/modules.php';

return [
    AssetManagerInterface::class => DI\create(AssetManager::class),
    PasswordHasherInterface::class => DI\factory(function () {
        $factory = new PasswordHasherFactory(
            [
                'common' => ['algorithm' => 'bcrypt'],
            ]
        );

        return $factory->getPasswordHasher('common');
    }),
    EventManagerInterface::class => DI\create(EventManager::class),
    KeyValueStorageInterface::class => DI\create(SessionStorage::class),
    FlashMessageManagerInterface::class => DI\factory(function (ContainerInterface $container){
        /** @var KeyValueStorageInterface $session */
        $session = $container->get(SessionStorage::class);
        return new FlashMessageManager($session);
    }),
    ...$repositories,
    ...$modules,
];