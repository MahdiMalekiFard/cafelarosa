<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class ErrorHelper
{
    /** @throws HttpResponseException */
    public static function ValidationError(array $errors = [], ?string $message = null): void
    {
        $validator  = Validator::make([], []);
        $messageBag = $validator->errors();
        foreach ($errors as $error) {
            foreach ($error as $key => $value) {
                $messageBag->add($key, $value);
            }
        }

        $errorsArray  = $validator->errors()->toArray();
        $firstKey     = array_key_first($validator->errors()->toArray());
        $firstMessage = $errorsArray[$firstKey][0];

        throw new HttpResponseException(response()->json([
            'message' => empty($message) ? $firstMessage : $message,
            'errors'  => $errorsArray,
        ], 422));
    }
}
