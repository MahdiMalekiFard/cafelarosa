<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="UpdateUserRequest",
 *      title="Update User request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class UpdateUserRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        return [
            'name'   => 'required|string|max:255',
            'mobile' => 'required',
            'email'  => 'required|email|unique:users,email,' . request()->user->id,
        ];
    }
}
