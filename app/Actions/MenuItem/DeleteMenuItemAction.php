<?php

namespace App\Actions\MenuItem;

use App\Models\MenuItem;
use App\Repositories\MenuItem\MenuItemRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class DeleteMenuItemAction
{
    use AsAction;

    public function __construct(public readonly MenuItemRepositoryInterface $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(MenuItem $menuItem): bool
    {
        return DB::transaction(function () use ($menuItem) {
            return $this->repository->delete($menuItem);
        });
    }
}
