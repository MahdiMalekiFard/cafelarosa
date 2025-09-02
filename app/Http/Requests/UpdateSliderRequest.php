<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="UpdateSliderRequest",
 *      title="Update Slider request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class UpdateSliderRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        $rules = (new StoreSliderRequest())->rules();
        $rules['image'] = ['nullable', 'image', 'max:2048', 'mimes:jpeg,jpg,png'];

        return array_merge($rules, [

        ]);
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'published' => true,
        ]);
    }
}
