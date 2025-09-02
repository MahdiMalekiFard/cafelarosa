<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Helpers\StringHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="UpdateCategoryRequest",
 *      title="Update Category request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class UpdateCategoryRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        $category = $this->route('category');
        $rules = (new StoreCategoryRequest())->rules();
        return array_merge($rules, [
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category->id),
            ],
        ]);
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug'            => StringHelper::slug($this->title),
            'published'       => true,
            'parent_id'       => null,
            'seo_title'       => $this->title,
            'seo_description' => $this->description,
        ]);
    }
}
