<?php

namespace App\Actions\Locality;

use App\Models\Locality;
use App\Repositories\Locality\LocalityRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteLocalityAction
{
    use AsAction;

    public function __construct(public readonly LocalityRepositoryInterface $repository)
    {
    }

    public function handle(Locality $locality): bool
    {
        return DB::transaction(function () use ($locality) {
            return $this->repository->delete($locality);
        });
    }
}
