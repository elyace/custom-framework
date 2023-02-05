<?php

namespace CFM\Shared\Factory;

use CFM\Shared\Storage\FlashMessage\FlashMessageManagerInterface;
use CFM\Shared\Vite\AssetManagerInterface;
use Illuminate\View\Environment;
use Spatie\Blade\Blade;

class TemplateEnvFactory
{

    public function __construct(
        private readonly AssetManagerInterface $assetManager,
        private readonly FlashMessageManagerInterface $messageManager
    )
    {
    }

    public function create(): Environment
    {
        $blade = new Blade(
            ROOT_PATH . '/templates',
            ROOT_PATH . '/var/cache',
        );

        $environment = $blade->view();

        $messages = $this->messageManager->read();
        $environment->share('notifications', $messages);

        if ('dev' === env('APP_ENV', 'dev')) {
            $environment->share('assets', $this->assetManager->getDevAssets());
        }

        if ('prod' === env('APP_ENV', 'dev')) {
            $environment->share('assets', $this->assetManager->getProdAssets());
        }

        return $environment;
    }
}