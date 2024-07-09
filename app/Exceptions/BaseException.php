<?php

namespace App\Exceptions;

use App\Lib\Traits\ResponseTrait;
use Exception;


class BaseException extends Exception
{
    use ResponseTrait;
}
