<?php

namespace App\Http\Middleware;

use Closure;
use App\Concerns\ApiResponse;
use App\Constants\HttpCodes;
use App\Webservices\AuthWebservice;
use Illuminate\Http\{JsonResponse, Request};
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    use ApiResponse;

    /**
     * Auth web service instance
     *
     * @var AuthWebservice
     */
    public AuthWebservice $authWebservice;

    /**
     * Create a new middleware instance
     *
     * @param AuthWebservice  $authWebservice auth web service instance
     */
    public function __construct(AuthWebservice $authWebservice)
    {
        $this->authWebservice = $authWebservice;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): JsonResponse|Response
    {
        $token = $request->bearerToken();

        if ($token === null) {
            return self::responseError('Missing token', HttpCodes::UNAUTHORIZED);
        }

        $response = $this->authWebservice->check($request->bearerToken());

        if ($response->unauthorized() === true) {
            return self::responseError('Unauthorized', HttpCodes::UNAUTHORIZED);
        }

        $request->attributes->set('user_id', $response->json('data.id'));
        $request->attributes->set('user_attributes', $response->json('data.attributes'));

        return $next($request);
    }
}
