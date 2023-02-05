<?php

namespace CFM;

use CFM\Controller\AbstractController;
use CFM\Shared\Attribute\RouteSecurityAttributeHandler;
use CFM\Shared\Data\Route;
use CFM\Shared\Event\EventManager;
use CFM\Shared\Event\EventManagerInterface;
use CFM\Shared\Factory\TemplateEnvFactory;
use CFM\Shared\Storage\KeyValueStorageInterface;
use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Kernel
{

    static private ?Kernel $instance = null;

    private ContainerInterface $container;

    private function __construct()
    {
    }

    public static function getInstance(): Kernel
    {
        if (null === self::$instance) {
            self::$instance = new Kernel();
        }

        return self::$instance;
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function boot(): void
    {
        $this->container = $this->buildContainer();
        $this->initEventListener();
        $app = Bridge::create($this->container);

        /** @var Route[] $routes */
        $routes = require_once CONFIG_PATH . '/routes/routes.php';

        foreach ($routes as $route) {
            $app->map($route->methods, $route->path, function (ServerRequestInterface $request, ResponseInterface $response, array $args = []) use ($route) {
                $handler = $this->container->get(RouteSecurityAttributeHandler::class);
                $handler->handle($route->handler);
                /** @var AbstractController $controller */
                $controller = $this->container->get($route->handler);
                /** @var TemplateEnvFactory $template */
                $template = $this->container->get(TemplateEnvFactory::class);
                $controller->setTemplate($template->create());

                return $controller($request, $args);
            });
        }

        $app->run();
    }

    public function initEventListener(): EventManagerInterface
    {
        $manager = new EventManager($this->container);
        $listeners = require CONFIG_PATH . '/event/listeners.php';

        foreach ($listeners as $listener => $events) {
            foreach ($events as $event) {
                $manager->subscribe($event, $listener);
            }
        }

        return $manager;
    }

    private function buildContainer(): Container
    {
        $builder = new ContainerBuilder();
        $builder->useAttributes(true);
        $builder->addDefinitions(CONFIG_PATH . '/services.php');

        return $builder->build();
    }

}