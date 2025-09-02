<?php

namespace App\Actions\Country;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Country;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCountryAction
{
    use AsAction;

    public function __construct(
        private readonly CountryRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param Country                                          $country
     * @param array{title:string,description:string}             $payload
     * @return Country
     */
    public function handle(Country $country, array $payload): Country
    {
        return DB::transaction(function () use ($country, $payload) {
            $this->repository->update($country, $payload);
            $this->syncTranslationAction->handle($country, Arr::only($payload, ['title', 'description', 'body']));

            return $country->refresh();
        });
    }
}
