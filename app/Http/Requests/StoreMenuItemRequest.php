<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StoreMenuItemRequest",
 *      title="Store MenuItem request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StoreMenuItemRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        return [
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string', 'max:255'],
            'menu_id'       => ['required', 'exists:menus,id'],
            'normal_price'  => ['required', 'numeric', 'min:1'],
            'special_price' => ['nullable', 'numeric', 'min:1', 'lte:normal_price'],
            'published'     => ['required', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'published'     => true,
            'special_price' => $this->special_price ?? $this->input('normal_price'),
        ]);
    }
}
