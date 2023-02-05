<?php

namespace CFM\Controller;

use CFM\Shared\Storage\FlashMessage\FlashMessageManagerInterface;
use DI\Attribute\Inject;
use Illuminate\View\Environment;
use Illuminate\View\View;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController
{

    private readonly Environment $template;

    private readonly FlashMessageManagerInterface $storage;

    abstract public function __invoke(ServerRequestInterface $request, array $args = []);

    /**
     * @param Environment $template
     * @return AbstractController
     */
    public function setTemplate(Environment $template): AbstractController
    {
        $this->template = $template;

        return $this;
    }

    #[Inject]
    public function setStorage(FlashMessageManagerInterface $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function render(string $view, array $data = []): View
    {
        $this->template->share('notifications', $this->storage->read());

        return $this->template->make($view, $data);
    }

    protected function successResponse(string $body): ResponseInterface
    {
        return new Response(200, [], $body);
    }
}