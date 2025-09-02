<?php

namespace App\Actions\City;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\City;
use App\Repositories\City\CityRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCityAction
{
    use AsAction;

    public function __construct(
        private readonly CityRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param City                                          $city
     * @param array{title:string,description:string}             $payload
     * @return City
     */
    public function handle(City $city, array $payload): City
    {
        return DB::transaction(function () use ($city, $payload) {
            $this->repository->update($city, $payload);
            $this->syncTranslationAction->handle($city, Arr::only($payload, ['title', 'description', 'body']));

            return $city->refresh();
        });
    }
}
