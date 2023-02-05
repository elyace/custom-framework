<?php

namespace CFM\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class HelloController extends AbstractController
{

    public function __invoke(Request $request, array $args = []): Response
    {
        $view = $this->template->make('hello');

        return $this->successResponse(
            $view->render()
        );
    }
}