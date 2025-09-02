<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StoreProfileRequest",
 *      title="Store Profile request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StoreProfileRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'email'  => ['email', 'max:255', 'unique:users,email'],
            'mobile' => ['string', 'max:255', 'unique:users,mobile'],
            'avatar' => ['nullable', 'image', 'max:1024', 'mimes:jpeg,png,jpg', 'dimensions:min_width=100,min_height=100'],
        ];
    }
}
