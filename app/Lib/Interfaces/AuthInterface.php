<?php

namespace App\Lib\Interfaces;

interface AuthInterface
{
    public function login(EncryptorInterface $encryptor, $validData);

    public function register(EncryptorInterface $encryptor, $validData, $notify = false);

    public function loginOperations($user);
}
