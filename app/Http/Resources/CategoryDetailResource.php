<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="CategoryDetailResource",
 *     title="CategoryDetailResource",
 *     @OA\Xml(name="CategoryDetailResource"),
 *     @OA\Property( property="id", type="integer", example="1"),
 *     @OA\Property(property="title", type="string", example="Category Title"),
 *     @OA\Property(property="description", type="string", example="Category Description"),
 *
 *     @OA\Property(property="updated_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 *     @OA\Property(property="created_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 * )
 */
class CategoryDetailResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $resource = CategoryResource::make($this)->toArray($request);
        $resource['id']=$this->id;

        return $resource;
    }
}
