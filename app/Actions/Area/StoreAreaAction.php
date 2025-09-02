<?php

namespace App\Actions\Area;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Area;
use App\Repositories\Area\AreaRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreAreaAction
{
    use AsAction;

    public function __construct(
        private readonly AreaRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}

    /**
     * @param array{title:string,description:string}             $payload
     * @return Area
     */
    public function handle(array $payload): Area
    {
        return DB::transaction(function () use ($payload) {
            /** @var Area $model */
            $model =  $this->repository->store($payload);
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));

            return $model->refresh();
        });
    }
}
