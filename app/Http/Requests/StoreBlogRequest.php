<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Requests\Traits\HasSeoValidation;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StoreBlogRequest",
 *      title="Store Blog request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StoreBlogRequest extends FormRequest
{
    use FillAttributes;
    use HasSeoValidation;

    public function rules(): array
    {
        return array_merge([
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string', 'max:255'],
            'body'            => ['required'],
            'categories_id'   => ['required', 'array'],
            'categories_id.*' => ['required', 'integer', 'exists:categories,id'],
            'tags'            => ['nullable', 'array'],
            'tags.*'          => ['required', 'string', 'max:255'],
            'image'           => ['nullable', 'image', 'max:2048', 'mimes:jpeg,jpg,png'],
            'published'       => ['required', 'boolean'],
        ], $this->getSeoRules());
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'published' => true,
        ]);
        
        $this->prepareSeoForValidation();
    }
}
