<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Lib\Classes\Services\v1\Encryptor\JwtEncryptor;
use App\Lib\Interfaces\AuthInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(AuthInterface $service)
    {
        $this->service = $service;
    }

    public function register(Request $request)
    {
        $encryptor = new JwtEncryptor();
        $validateDate = $this->service->validateRequest($request->all(), 'user_registration');
        return $this->service->register($encryptor, $validateDate);
    }

    public function login(Request $request)
    {
        $encryptor = new JwtEncryptor();
        $validateDate = $this->service->validateRequest($request->all(), 'user_login');
        return $this->service->login($encryptor, $validateDate);
    }
}
