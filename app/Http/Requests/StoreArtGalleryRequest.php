<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Requests\Traits\HasSeoValidation;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StoreArtGalleryRequest",
 *      title="Store ArtGallery request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StoreArtGalleryRequest extends FormRequest
{
    use FillAttributes;
    use HasSeoValidation;

    public function rules(): array
    {
        return array_merge([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
        ], $this->getSeoRules());
    }

    protected function prepareForValidation(): void
    {
        $this->prepareSeoForValidation();
    }
}
