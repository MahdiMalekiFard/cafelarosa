<?php

namespace App\Actions\Area;

use App\Models\Area;
use App\Repositories\Area\AreaRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteAreaAction
{
    use AsAction;

    public function __construct(public readonly AreaRepositoryInterface $repository)
    {
    }

    public function handle(Area $area): bool
    {
        return DB::transaction(function () use ($area) {
            return $this->repository->delete($area);
        });
    }
}
