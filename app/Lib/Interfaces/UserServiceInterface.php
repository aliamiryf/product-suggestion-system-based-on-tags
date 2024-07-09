<?php

namespace App\Lib\Interfaces;

interface UserServiceInterface
{
    public static function getUser($data);

    public static function getProfileWithId($id);

    public function performingGetProfile(EncryptorInterface $encryptor, $token);
}
