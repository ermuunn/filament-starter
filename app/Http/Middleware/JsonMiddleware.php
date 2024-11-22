<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

class JsonMiddleware
{
    protected $factory;

    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if($request->is('api/*')) {
            $request->headers->set('Accept', 'application/json');
            $request->headers->set('Content-type', 'application/json');
            $response = $next($request);

            if (!$response instanceof JsonResponse) {
                $response = $this->factory->json(
                    $response->content(),
                    $response->status(),
                    $response->headers->all()
                );
            }

            return $response;
        } else {
            $response = $next($request);
            return $response;
        }
    }
}
