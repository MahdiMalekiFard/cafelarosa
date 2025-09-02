<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\PageTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="StorePageRequest",
 *      title="Store Page request",
 *      type="object",
 *      required={"title"},
 *
 *     @OA\Property(property="title", type="string", example="test title"),
 *     @OA\Property(property="description", type="string", example="test description"),
 * )
 */
class StorePageRequest extends FormRequest
{
    use FillAttributes;

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
            'type'  => ['required', Rule::in(PageTypeEnum::values())],
        ];
    }
}
