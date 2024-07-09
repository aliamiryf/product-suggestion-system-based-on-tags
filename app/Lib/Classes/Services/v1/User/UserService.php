<?php

namespace App\Lib\Classes\Services\v1\User;

use App\Lib\Classes\Services\BaseService;
use App\Lib\Interfaces\EncryptorInterface;
use App\Lib\Interfaces\UserServiceInterface;
use App\Models\User;

class UserService extends BaseService implements UserServiceInterface
{
    public function __construct()
    {
        $this->setCollects(\App\Http\Resources\User::class);
    }

    public static function getUser($data)
    {
        if (array_key_exists('email', $data)) {
            return User::where('email', $data['email'])->first();
        }
    }

    public static function getUserFromToken(EncryptorInterface $encryptor, $token)
    {
        $decodedToken = $encryptor->decode($token);
        return static::getProfileWithId($decodedToken->userId);

    }

    public static function getProfileWithId($id)
    {
        return User::findOrFail($id);
    }

    public function performingGetProfile(EncryptorInterface $encryptor, $token)
    {
        $decodedToken = $encryptor->decode($token);
        $user = static::getProfileWithId($decodedToken->userId);
        return static::success(null, $this->resource($user, false, 'user'), 200);
    }
}
