<?php

namespace App\Actions\ArtGallery;

use App\Models\ArtGallery;
use App\Repositories\ArtGallery\ArtGalleryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class DeleteArtGalleryAction
{
    use AsAction;

    public function __construct(public readonly ArtGalleryRepositoryInterface $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(ArtGallery $artGallery): bool
    {
        return DB::transaction(function () use ($artGallery) {
            return $this->repository->delete($artGallery);
        });
    }
}
