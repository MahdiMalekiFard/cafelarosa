<?php

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="CityResource",
 *     title="CityResource",
 *     @OA\Xml(name="CityResource"),
 *     @OA\Property( property="id", type="integer", example="1"),
 *     @OA\Property(property="title", type="string", example="City Title"),
 *     @OA\Property(property="description", type="string", example="City Description"),
 *
 *     @OA\Property(property="updated_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 *     @OA\Property(property="created_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 * )
 */
class CityResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'updated_at'  => $this->updated_at,
            'created_at'  => $this->created_at,
        ];
    }
}
