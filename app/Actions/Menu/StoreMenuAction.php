<?php

namespace App\Actions\Menu;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Menu;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Services\File\FileService;
use App\Services\SeoOption\SeoOptionService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StoreMenuAction
{
    use AsAction;

    public function __construct(
        private readonly MenuRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
        private readonly FileService $fileService,
        private readonly SeoOptionService $seoOptionService
    )
    {
    }

    /**
     * @param array{title:string,description:string,image:string,left_image:string,right_image:string,published:boolean,parent_id:int} $payload
     * @return Menu
     * @throws Throwable
     */
    public function handle(array $payload): Menu
    {
        return DB::transaction(function () use ($payload) {
            /** @var Menu $model */
            $model = $this->repository->store(Arr::only($payload, ['published', 'parent_id']));
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description']));
            $this->fileService->addMedia($model);
            $this->fileService->addMedia($model, 'left_image', 'left_image');
            $this->fileService->addMedia($model, 'right_image', 'right_image');
            $this->seoOptionService->create($model, $payload);
            return $model->refresh();
        });
    }
}
