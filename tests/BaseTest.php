<?php

use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../config/defines.php';
require_once __DIR__ . '/../vendor/autoload.php';

class BaseTest extends TestCase
{

    protected ContainerInterface $container;

    /**
     * @throws Exception
     */
    public function __construct(string $name)
    {

        $builder = new ContainerBuilder();
        $builder->useAttributes(true);
        $builder->useAutowiring(false);
        $builder->addDefinitions(CONFIG_PATH . '/services.php');
        $this->container = $builder->build();
        parent::__construct($name);
    }
}