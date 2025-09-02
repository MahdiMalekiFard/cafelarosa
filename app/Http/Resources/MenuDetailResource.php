<?php

namespace App\Http\Resources;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="MenuDetailResource",
 *     title="MenuDetailResource",
 *     @OA\Xml(name="MenuDetailResource"),
 *     @OA\Property( property="id", type="integer", example="1"),
 *     @OA\Property(property="title", type="string", example="Menu Title"),
 *     @OA\Property(property="description", type="string", example="Menu Description"),
 *
 *     @OA\Property(property="updated_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 *     @OA\Property(property="created_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 * )
 */
class MenuDetailResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $resource = MenuResource::make($this)->toArray($request);
        $resource['id']=$this->id;

        return $resource;
    }
}
