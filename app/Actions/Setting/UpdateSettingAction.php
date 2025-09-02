<?php

namespace App\Actions\Setting;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Setting;
use App\Repositories\Setting\SettingRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateSettingAction
{
    use AsAction;

    public function __construct(
        private readonly SettingRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param Setting                                          $setting
     * @param array{title:string,description:string}             $payload
     * @return Setting
     */
    public function handle(Setting $setting, array $payload): Setting
    {
        return DB::transaction(function () use ($setting, $payload) {
            $this->repository->update($setting, $payload);
            $this->syncTranslationAction->handle($setting, Arr::only($payload, ['title', 'description', 'body']));

            return $setting->refresh();
        });
    }
}
