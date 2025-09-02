<?php

namespace App\Actions\Setting;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Setting;
use App\Repositories\Setting\SettingRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreSettingAction
{
    use AsAction;

    public function __construct(
        private readonly SettingRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}

    /**
     * @param array{title:string,description:string}             $payload
     * @return Setting
     */
    public function handle(array $payload): Setting
    {
        return DB::transaction(function () use ($payload) {
            /** @var Setting $model */
            $model =  $this->repository->store($payload);
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));

            return $model->refresh();
        });
    }
}
