<?php

namespace App\Lib\Traits;

trait ResponseTrait
{
    public static function sendJsonResponse($type, $message = null, array $data = [], $code = null, $errorCode = -1)
    {
        if ($code == null) {
            $code = ($type != 'FAILURE') ? 200 : 400;
        }

        $response = [
            'type' => $type,
            'message' => $message,
            'data' => $data
        ];

        if ($type == 'FAILURE') {
            $response['errorCode'] = $errorCode;
        }

        return response()->json($response, $code);

    }

    public static function success($message = 'responses.success', array $data = [], $code = 200)
    {
        return static::sendJsonResponse('SUCCESS', __($message), $data, $code);
    }

    public static function failure($message = 'messages.failure', array $data = [], $code = 400, $errorCode = -1)
    {
        return static::sendJsonResponse('FAILURE', __($message), $data, $code, $errorCode);
    }

    public static function getFirstValidatorError($errors)
    {
        return $errors[array_keys($errors)[0]][0];
    }

    public static function successOrFailure($boolean, $message = null, array $data = [], $code = 200, $errorCode = -1)
    {
        if (empty($message))
            $message = $boolean ? 'responses.success' : 'responses.failure';

        return $boolean ? self::success($message, $data, $code) : self::failure($message, $data, $code, $errorCode);
    }
}
