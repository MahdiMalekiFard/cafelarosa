<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TranslationResource",
 *     title="TranslationResource",
 *     @OA\Xml(name="TranslationResource"),
 *     @OA\Property( property="id", type="integer", example="1"),
 * )
 */
class TranslationResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
