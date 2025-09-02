<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StoreContactRequest",
 *      title="Store Contact request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StoreContactRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|string|email|max:255',
            'phone'   => 'required|regex:/^\+?[1-9]\d{7,14}$/',
            'message' => 'required|string',
        ];
    }
}
