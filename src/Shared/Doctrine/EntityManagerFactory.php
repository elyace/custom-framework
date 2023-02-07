<?php

namespace CFM\Shared\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;

final class EntityManagerFactory
{

    private ?EntityManagerInterface $manager = null;

    private static ?EntityManagerFactory $instance = null;

    public static function getInstance(): EntityManagerFactory
    {

        if( null === self::$instance )
        {
            self::$instance = new EntityManagerFactory();
        }

        return self::$instance;
    }

    /**
     * @throws MissingMappingDriverImplementation
     * @throws Exception
     */
    public function create(): EntityManagerInterface
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: array(ROOT_PATH . '/persistence/Entity'),
            isDevMode: 'dev' === env('APP_ENV'),
        );
        $connectionConfig = require CONFIG_PATH . '/doctrine.php';
        $connection = DriverManager::getConnection($connectionConfig, $config);

        if( null === $this->manager )
        {
            $this->manager = new EntityManager($connection, $config);
        }

        return $this->manager;
    }
}