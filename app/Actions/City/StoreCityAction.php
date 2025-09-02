<?php

namespace App\Actions\City;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\City;
use App\Repositories\City\CityRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCityAction
{
    use AsAction;

    public function __construct(
        private readonly CityRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}

    /**
     * @param array{title:string,description:string}             $payload
     * @return City
     */
    public function handle(array $payload): City
    {
        return DB::transaction(function () use ($payload) {
            /** @var City $model */
            $model =  $this->repository->store($payload);
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));

            return $model->refresh();
        });
    }
}
