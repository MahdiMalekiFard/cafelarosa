<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\CategoryTypeEnum;
use App\Helpers\StringHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StoreCategoryRequest",
 *      title="Store Category request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StoreCategoryRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string', 'max:255'],
            'body'            => ['nullable', 'string'],
            'published'       => ['required', 'boolean'],
            'parent_id'       => ['nullable', 'integer', 'exists:categories,id'],
            'slug'            => ['required', 'string', 'max:255', 'unique:categories,slug'],
            'type'            => ['required', 'string', 'in:' . implode(',', CategoryTypeEnum::values())],
            'seo_title'       => ['required', 'string', 'max:255'],
            'seo_description' => ['required', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug'            => StringHelper::slug($this->title),
            'published'       => true,
            'parent_id'       => null,
            'seo_title'       => $this->title,
            'seo_description' => Str::limit($this->description, 80),
        ]);
    }
}
