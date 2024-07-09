<?php

namespace App\Exceptions;

use App\Lib\Traits\ResponseTrait;
use Throwable;

class RequestValidationException extends BaseException
{
    protected $errors;
    protected $message;

    public function __construct($message, $errors = [])
    {
        parent::__construct(__($message));
        $this->errors = $errors;
        $this->message = $message;
    }

    public function render()
    {
        return static::failure($this->message, $this->errors);
    }
}
