<?php

namespace App\Lib\Interfaces;

interface EncryptorInterface
{
    public function generate($data);

    public function decode($token);

}
