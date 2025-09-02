<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StoreMenuRequest",
 *      title="Store Menu request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StoreMenuRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'image'       => ['required', 'image', 'max:2048', 'mimes:jpeg,jpg,png'],
            'left_image'  => ['required', 'image', 'max:2048', 'mimes:jpeg,jpg,png'],
            'right_image' => ['required', 'image', 'max:2048', 'mimes:jpeg,jpg,png'],
            'published'   => ['required', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'published' => $this->input('published') ?? true
        ]);
    }
}
