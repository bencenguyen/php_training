<?php

namespace Middleware;

use Request;
use Response;
use Services\AuthService;

class AuthorizationMiddleware implements Middleware
{
    private $protectedUrls;

    private $authService;

    private $loginUrl;

    public function __construct(array $protectedUrls, AuthService $authService, $loginUrl)
    {
        $this->protectedUrls = $protectedUrls;
        $this->authService = $authService;
        $this->loginUrl = $loginUrl;
    }

    public function process(Request $request, Response $response, callable $next)
    {
        if (in_array($request->getUri(), $this->protectedUrls) && !$this->authService->check()) {
            return Response::redirect($this->loginUrl);
        }
        return $next($request, $response);
    }


}