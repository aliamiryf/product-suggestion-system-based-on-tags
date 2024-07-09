<?php

namespace App\Exceptions;

use App\Lib\Traits\ResponseTrait;

class Unauthenticated extends BaseException
{

    public function render()
    {
        return static::failure(__('auth.unauthenticated'), [], 401);
    }
}
