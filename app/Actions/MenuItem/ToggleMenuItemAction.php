<?php

declare(strict_types=1);

namespace App\Actions\MenuItem;

use App\Models\MenuItem;
use App\Repositories\MenuItem\MenuItemRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class ToggleMenuItemAction
{
    use AsAction;

    public function __construct(private readonly MenuItemRepositoryInterface $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle($menuItem): MenuItem
    {
        return DB::transaction(function () use ($menuItem) {
            /** @var MenuItem $menuItem */
            $menuItem = $this->repository->toggle($menuItem);

            return $menuItem->refresh();
        });
    }
}
