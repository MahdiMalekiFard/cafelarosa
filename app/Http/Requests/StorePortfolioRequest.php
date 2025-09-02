<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StorePortfolioRequest",
 *      title="Store Portfolio request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StorePortfolioRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string', 'max:255'],
            'body'            => ['required', 'string'],
            'categories_id'   => ['required', 'array'],
            'categories_id.*' => ['required', 'integer', 'exists:categories,id'],
            'tags'            => ['nullable', 'array'],
            'tags.*'          => ['required', 'string', 'max:255'],
            'seo_title'       => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'image'           => ['nullable', 'image', 'max:2048', 'mimes:jpeg,jpg,png'],
            'published'       => ['required', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'published'       => true,
            'seo_title'       => $this->seo_title ?? $this->title,
            'seo_description' => $this->seo_description ?? Str::limit($this->description, 80),
        ]);
    }
}
