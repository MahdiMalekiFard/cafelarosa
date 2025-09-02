<?php

declare(strict_types=1);

namespace App\Actions\Profile;

use App\ExtraAttributes\ProfileExtraEnum;
use App\Models\Profile;
use App\Repositories\Profile\ProfileRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePersonalSettingAction
{
    use AsAction;

    public function __construct(public readonly ProfileRepositoryInterface $repository) {}

    public function handle(Profile $profile, array $payload = []): Profile
    {
        return DB::transaction(function () use ($profile, $payload) {
            $profile->extra_attributes->set(ProfileExtraEnum::CONTAINER->value, Arr::get($payload, ProfileExtraEnum::CONTAINER->value));
            $profile->extra_attributes->set(ProfileExtraEnum::THEME->value, Arr::get($payload, ProfileExtraEnum::THEME->value));
            $profile->extra_attributes->set(ProfileExtraEnum::LANGUAGE->value, Arr::get($payload, ProfileExtraEnum::LANGUAGE->value));
            $profile->save();

            return $profile->refresh();
        });
    }
}
