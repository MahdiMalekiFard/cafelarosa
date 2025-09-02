<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\ArtGalleryTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="UpdateArtGalleryRequest",
 *      title="Update ArtGallery request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class UpdateArtGalleryRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        $rules = (new StoreArtGalleryRequest())->rules();
        return array_merge($rules, [

        ]);
    }
}
