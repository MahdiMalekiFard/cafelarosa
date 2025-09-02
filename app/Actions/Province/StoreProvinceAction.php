<?php

namespace App\Actions\Province;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Province;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProvinceAction
{
    use AsAction;

    public function __construct(
        private readonly ProvinceRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}

    /**
     * @param array{title:string,description:string}             $payload
     * @return Province
     */
    public function handle(array $payload): Province
    {
        return DB::transaction(function () use ($payload) {
            /** @var Province $model */
            $model =  $this->repository->store($payload);
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));

            return $model->refresh();
        });
    }
}
