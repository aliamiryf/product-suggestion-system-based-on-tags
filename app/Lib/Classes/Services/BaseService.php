<?php

namespace App\Lib\Classes\Services;

use App\Exceptions\RequestValidationException;
use App\Http\Resources\GeneralCollection;
use App\Lib\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;

class BaseService
{
    use ResponseTrait;


    protected $rules = [];
    protected $errorMessages = [];
    protected $collects;
    protected $model;

    protected function query()
    {
        return $this->model::query();
    }

    public function search(array $data = [])
    {
        return $this->query()->filter($data);
    }

    public function throwException($errors = [], $message = 'responses.validation.generalError')
    {
        throw new RequestValidationException(__($message), $errors);
    }


    public function validateRequest($data, $ruleKey = null, $rules = [])
    {

        if ($ruleKey) {
            $rules = array_merge($this->rules[$ruleKey]['rules'], $rules);
        }

        $message = $this->rules[$ruleKey]['message'] ?? null;

        $validator = Validator::make($data, $rules, $this->getValidationMessages());


        if ($validator->fails()) {
            $this->throwException($validator->errors()->jsonSerialize(),$message);
        }
        return $validator->validated();
    }

    public function getValidationMessages()
    {
        return $this->errorMessages;
    }

    public function resource($data, $response = false, $dataKey = null)
    {
        return $this->checkWantsResponse((new $this->collects($data))->jsonSerialize(), $response, $dataKey);
    }

    public function resourceCollection($data, $dataKey, $response = false)
    {
        $data = (new GeneralCollection($data, $this->collects, $dataKey))->jsonSerialize();
        if ($response) {
            return static::success('responses.success', $data);
        } else {
            return $data;
        }
    }

    private function checkWantsResponse($data, $response, $dataKey)
    {
        if ($response) {
            if (!empty($dataKey))
                $data = [$dataKey => $data];
            return static::success('responses.success', $data);
        }
        return $data;
    }

    public function setCollects($collects)
    {
        $this->collects = $collects;
        return $this;
    }


}
