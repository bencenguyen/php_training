<?php

class MiddlewareStack
{
    private $middlewares = [];

    public function addMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function __invoke(Request $request, Response $response)
    {
        $middleware = array_shift($this->middlewares);

        if ($middleware == null) {
            return $response;
        }

        return $middleware->process($request, $response, $this);
    }
}