<?php

namespace App\Actions\Locality;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Locality;
use App\Repositories\Locality\LocalityRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreLocalityAction
{
    use AsAction;

    public function __construct(
        private readonly LocalityRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}

    /**
     * @param array{title:string,description:string}             $payload
     * @return Locality
     */
    public function handle(array $payload): Locality
    {
        return DB::transaction(function () use ($payload) {
            /** @var Locality $model */
            $model =  $this->repository->store($payload);
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));

            return $model->refresh();
        });
    }
}
