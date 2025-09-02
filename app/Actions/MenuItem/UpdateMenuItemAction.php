<?php

namespace App\Actions\MenuItem;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\MenuItem;
use App\Repositories\MenuItem\MenuItemRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class UpdateMenuItemAction
{
    use AsAction;

    public function __construct(
        private readonly MenuItemRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    )
    {
    }


    /**
     * @param MenuItem $menuItem
     * @param array{
     *     title:string,
     *     description:string,
     *     menu_id:string,
     *     normal_price:string,
     *     special_price:string,
     *     published:string,
     * }               $payload
     * @return MenuItem
     * @throws Throwable
     */
    public function handle(MenuItem $menuItem, array $payload): MenuItem
    {
        return DB::transaction(function () use ($menuItem, $payload) {
            $this->repository->update($menuItem, Arr::only($payload, [
                'published', 'normal_price', 'special_price', 'menu_id',
            ]));
            $this->syncTranslationAction->handle($menuItem, Arr::only($payload, ['title', 'description']));

            return $menuItem->refresh();
        });
    }
}
