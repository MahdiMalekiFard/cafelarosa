<?php

namespace App\Actions\MenuItem;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\MenuItem;
use App\Repositories\MenuItem\MenuItemRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StoreMenuItemAction
{
    use AsAction;

    public function __construct(
        private readonly MenuItemRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    )
    {
    }

    /**
     * @param array{
     *     title:string,
     *     description:string,
     *     menu_id:string,
     *     normal_price:string,
     *     special_price:string,
     *     published:string,
     *     } $payload
     * @return MenuItem
     * @throws Throwable
     */
    public function handle(array $payload): MenuItem
    {
        return DB::transaction(function () use ($payload) {
            /** @var MenuItem $model */
            $model = $this->repository->store(Arr::only($payload, [
                'published', 'normal_price', 'special_price', 'menu_id',
            ]));
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description']));

            return $model->refresh();
        });
    }
}
