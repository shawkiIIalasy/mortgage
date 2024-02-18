<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiResponder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class FormRequest extends BaseFormRequest
{
    use ApiResponder;

    protected function failedValidation(Validator $validator)
    {
        $response = $this->error('Bad Request', ResponseAlias::HTTP_BAD_REQUEST, $validator->errors());

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
