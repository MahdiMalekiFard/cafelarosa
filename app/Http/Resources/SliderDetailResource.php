<?php

namespace App\Http\Resources;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SliderDetailResource",
 *     title="SliderDetailResource",
 *     @OA\Xml(name="SliderDetailResource"),
 *     @OA\Property( property="id", type="integer", example="1"),
 *     @OA\Property(property="title", type="string", example="Slider Title"),
 *     @OA\Property(property="description", type="string", example="Slider Description"),
 *
 *     @OA\Property(property="updated_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 *     @OA\Property(property="created_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 * )
 */
class SliderDetailResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $resource = SliderResource::make($this)->toArray($request);
        $resource['id']=$this->id;

        return $resource;
    }
}
