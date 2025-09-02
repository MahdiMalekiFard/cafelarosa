<?php

namespace App\Actions\Menu;

use App\Models\Menu;
use App\Repositories\Menu\MenuRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class DeleteMenuAction
{
    use AsAction;

    public function __construct(public readonly MenuRepositoryInterface $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(Menu $menu): bool
    {
        return DB::transaction(function () use ($menu) {
            return $this->repository->delete($menu);
        });
    }
}
