<?php

namespace App\Http\Resources;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ProfileDetailResource",
 *     title="ProfileDetailResource",
 *     @OA\Xml(name="ProfileDetailResource"),
 *     @OA\Property( property="id", type="integer", example="1"),
 *     @OA\Property(property="title", type="string", example="Profile Title"),
 *     @OA\Property(property="description", type="string", example="Profile Description"),
 *
 *     @OA\Property(property="updated_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 *     @OA\Property(property="created_at", type="string", example="2024-08-19T07:26:07.000000Z"),
 * )
 */
class ProfileDetailResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $resource = ProfileResource::make($this)->toArray($request);
        $resource['id']=$this->id;

        return $resource;
    }
}
