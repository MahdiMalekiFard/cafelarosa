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

class UpdateArtGalleryAction
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
     * @param ArtGallery $artGallery
     * @param array{
     *     title:string,
     *     description:string,
     *     image:string,
     * }                 $payload
     * @return ArtGallery
     * @throws Throwable
     */
    public function handle(ArtGallery $artGallery, array $payload): ArtGallery
    {
        return DB::transaction(function () use ($artGallery, $payload) {
            $this->repository->update($artGallery, $payload);
            $this->syncTranslationAction->handle($artGallery, Arr::only($payload, ['title', 'description']));

            $this->fileService->addMedia($artGallery);

            $this->fileService->updateFromDropzone(
                $artGallery,
                collection: 'gallery',
            );

            return $artGallery->refresh();
        });
    }
}
