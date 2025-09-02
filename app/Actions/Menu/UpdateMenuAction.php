<?php

namespace App\Actions\Menu;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Menu;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class UpdateMenuAction
{
    use AsAction;

    public function __construct(
        private readonly MenuRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
        private readonly FileService $fileService,
    )
    {
    }


    /**
     * @param Menu                                   $menu
     * @param array{
     *     title:string,
     *     description:string,
     *     published:boolean,
     *     image:string,
     *     left_image:string,
     *     right_image:string,
     *     } $payload
     * @return Menu
     * @throws Throwable
     */
    public function handle(Menu $menu, array $payload): Menu
    {
        return DB::transaction(function () use ($menu, $payload) {
            $this->repository->update($menu, Arr::only($payload, ['published']));
            $this->syncTranslationAction->handle($menu, Arr::only($payload, ['title', 'description']));
            $this->fileService->addMedia($menu);
            $this->fileService->addMedia($menu, 'left_image', 'left_image');
            $this->fileService->addMedia($menu, 'right_image', 'right_image');

            return $menu->refresh();
        });
    }
}
