<?php

namespace App\Http\Middleware;

use App\Exceptions\Unauthenticated;
use App\Lib\Classes\Services\v1\User\UserService;
use App\Lib\Interfaces\EncryptorInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    private $encryptor;

    public function __construct(EncryptorInterface $encryptor)
    {
        $this->encryptor = $encryptor;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @throws Unauthenticated
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = UserService::getUserFromToken($this->encryptor, $request->header('authorization'));
            Auth::login($user);
            return $next($request);
        } catch (\Exception $exception) {
            throw new Unauthenticated();
        }
    }
}
