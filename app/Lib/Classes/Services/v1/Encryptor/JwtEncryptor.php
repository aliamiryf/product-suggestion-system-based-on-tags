<?php

namespace App\Lib\Classes\Services\v1\Encryptor;

use App\Lib\Interfaces\EncryptorInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtEncryptor implements EncryptorInterface
{
    private $key;

    public function __construct()
    {
        $this->key = config('jwt.key');
    }

    public function generate($data)
    {
        $jwt = JWT::encode($data, $this->key, 'HS256');
        return $jwt;

    }

    public function decode($token)
    {
        try {
            $token = str_replace('Bearer ', '', $token);
            return JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (\Exception $exception) {
            return $exception;
        }

    }
}
