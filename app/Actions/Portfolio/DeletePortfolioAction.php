<?php

namespace App\Actions\Portfolio;

use App\Models\Portfolio;
use App\Repositories\Portfolio\PortfolioRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class DeletePortfolioAction
{
    use AsAction;

    public function __construct(public readonly PortfolioRepositoryInterface $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(Portfolio $portfolio): bool
    {
        return DB::transaction(function () use ($portfolio) {
            return $this->repository->delete($portfolio);
        });
    }
}
