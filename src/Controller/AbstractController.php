<?php

namespace CFM\Controller;

use CFM\Shared\Factory\TemplateEnvFactory;
use DI\Attribute\Inject;
use Illuminate\View\Environment;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController
{

    protected Environment $template;

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

    protected function successResponse(string $body): ResponseInterface
    {
        return new Response(200, [], $body);
    }
}