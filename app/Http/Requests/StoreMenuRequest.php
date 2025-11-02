<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Requests\Traits\HasSeoValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
    use HasSeoValidation;

    public function rules(): array
    {
        return array_merge([
            'title'       => ['required', 'string', 'max:255'],
            'parent_id'   => ['nullable', 'integer', 'exists:menus,id'],
            'description' => ['required', 'string', 'max:255'],
            'image'       => ['required', 'image', 'max:2048', 'mimes:jpeg,jpg,png'],
            'left_image'  => [
                Rule::requiredIf(fn() => in_array($this->input('parent_id'), [null, ''], true) || $this->input('parent_id') === 'null'),
                'image', 'max:2048', 'mimes:jpeg,jpg,png',
            ],
            'right_image' => [
                Rule::requiredIf(fn() => in_array($this->input('parent_id'), [null, ''], true) || $this->input('parent_id') === 'null'),
                'image', 'max:2048', 'mimes:jpeg,jpg,png',
            ],
            'published' => ['required', 'boolean'],
        ], $this->getSeoRules());
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'published' => $this->input('published') ?? true,
        ]);
        
        $this->prepareSeoForValidation();
    }
}
