<?php

declare(strict_types=1);

namespace App\Actions\Menu;

use App\Models\Blog;
use App\Models\Menu;
use App\Repositories\Menu\MenuRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class ToggleMenuAction
{
    use AsAction;

    public function __construct(private readonly MenuRepositoryInterface $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle($menu): Menu
    {
        return DB::transaction(function () use ($menu) {
            /** @var Blog $menu */
            $menu = $this->repository->toggle($menu);

            return $menu->refresh();
        });
    }
}
