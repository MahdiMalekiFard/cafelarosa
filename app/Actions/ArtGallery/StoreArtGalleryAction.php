<?php

namespace App\Actions\ArtGallery;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\ArtGallery;
use App\Repositories\ArtGallery\ArtGalleryRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StoreArtGalleryAction
{
    use AsAction;

    public function __construct(
        private readonly ArtGalleryRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
        private readonly FileService $fileService,
    )
    {
    }

    /**
     * @param array{
     *     title:string,
     *     description:string,
     *     image:string,
     * } $payload
     * @return ArtGallery
     * @throws Throwable
     */
    public function handle(array $payload): ArtGallery
    {
        return DB::transaction(function () use ($payload) {
            /** @var ArtGallery $model */
            $model = $this->repository->store(Arr::except($payload, ['title', 'description']));
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description']));

            $this->fileService->addMedia($model);

            $this->fileService->addFromDropzone(
                $model,
                collection: 'gallery',
            );

            return $model->refresh();
        });
    }
}
