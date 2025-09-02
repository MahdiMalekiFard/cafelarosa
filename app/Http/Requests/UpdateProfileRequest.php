<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="UpdateProfileRequest",
 *      title="Update Profile request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class UpdateProfileRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        $rules = (new StoreProfileRequest())->rules();
        return array_merge($rules, [
            'email'  => ['email', 'max:255', 'unique:users,email,' . $this->profile->user_id],
            'mobile' => ['string', 'max:255', 'unique:users,mobile,' . $this->profile->user_id],
        ]);
    }
}
