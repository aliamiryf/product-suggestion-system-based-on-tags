<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Lib\Classes\Services\v1\Encryptor\JwtEncryptor;
use App\Lib\Classes\Services\v1\User\UserService;
use App\Lib\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function getProfile(Request $request)
    {
        $encryptor = new JwtEncryptor();
        return $this->service->performingGetProfile($encryptor, $request->header('Authorization'));
    }
}
