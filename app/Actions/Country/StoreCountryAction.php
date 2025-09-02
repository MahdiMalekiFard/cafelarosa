<?php

namespace App\Actions\Country;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Country;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCountryAction
{
    use AsAction;

    public function __construct(
        private readonly CountryRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}

    /**
     * @param array{title:string,description:string}             $payload
     * @return Country
     */
    public function handle(array $payload): Country
    {
        return DB::transaction(function () use ($payload) {
            /** @var Country $model */
            $model =  $this->repository->store($payload);
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));

            return $model->refresh();
        });
    }
}
