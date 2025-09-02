<?php

namespace App\Actions\Country;

use App\Models\Country;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCountryAction
{
    use AsAction;

    public function __construct(public readonly CountryRepositoryInterface $repository)
    {
    }

    public function handle(Country $country): bool
    {
        return DB::transaction(function () use ($country) {
            return $this->repository->delete($country);
        });
    }
}
