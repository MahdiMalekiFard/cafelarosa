<?php

namespace App\Actions\Province;

use App\Models\Province;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteProvinceAction
{
    use AsAction;

    public function __construct(public readonly ProvinceRepositoryInterface $repository)
    {
    }

    public function handle(Province $province): bool
    {
        return DB::transaction(function () use ($province) {
            return $this->repository->delete($province);
        });
    }
}
