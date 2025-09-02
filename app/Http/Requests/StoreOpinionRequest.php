<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StoreOpinionRequest",
 *      title="Store Opinion request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StoreOpinionRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        return [
            'subject'   => ['required', 'string', 'max:255'],
            'comment'   => ['required', 'string'],
            'user_name' => ['required', 'string', 'max:255'],
            'company'   => ['nullable', 'string', 'max:255'],
            'ordering'  => ['required', 'integer', 'min:1'],
        ];
    }
}
