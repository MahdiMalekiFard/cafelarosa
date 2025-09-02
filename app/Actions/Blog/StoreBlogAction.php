<?php

declare(strict_types=1);

namespace App\Actions\Blog;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StoreBlogAction
{
    use AsAction;

    public function __construct(
        private readonly BlogRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
        private readonly FileService $fileService
    ) {}

    /**
     * @throws Throwable
     */
    public function handle(array $payload): Blog
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store(array_merge(Arr::only($payload, [
                'slug', 'seo_title', 'seo_description', 'published', 'type',
            ]), [
                'user_id' => auth()->id() ?? 1,
            ]));
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));
            $model->categories()->sync(Arr::get($payload, 'categories_id', []));
            $model->tags()->sync(Arr::get($payload, 'tags_id', []));
            $this->fileService->addMedia($model);
            return $model->refresh();
        });
    }
}
