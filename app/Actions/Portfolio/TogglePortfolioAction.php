<?php

declare(strict_types=1);

namespace App\Actions\Portfolio;

use App\Models\Portfolio;
use App\Repositories\Portfolio\PortfolioRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class TogglePortfolioAction
{
    use AsAction;

    public function __construct(private readonly PortfolioRepositoryInterface $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle($portfolio): Portfolio
    {
        return DB::transaction(function () use ($portfolio) {
            /** @var Portfolio $portfolio */
            $portfolio = $this->repository->toggle($portfolio);

            return $portfolio->refresh();
        });
    }
}
