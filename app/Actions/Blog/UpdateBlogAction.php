<?php

declare(strict_types=1);

namespace App\Actions\Blog;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\File\FileService;
use App\Services\SeoOption\SeoOptionService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class UpdateBlogAction
{
    use AsAction;

    public function __construct(
        private readonly BlogRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
        private readonly FileService $fileService,
        private readonly SeoOptionService $seoOptionService
    ) {}

    /** @param array{name:string,mobile:string,email:string} $payload
     * @throws Throwable
     */
    public function handle(Blog $blog, array $payload): Blog
    {
        return DB::transaction(function () use ($blog, $payload) {
            $this->repository->update($blog, Arr::only($payload, [
                'slug', 'published', 'type',
            ]));
            $this->syncTranslationAction->handle($blog, Arr::only($payload, ['title', 'description', 'body']));
            $blog->categories()->sync(Arr::get($payload, 'categories_id', []));
            $blog->tags()->sync(Arr::get($payload, 'tags_id', []));
            $this->fileService->addMedia($blog);
            $this->seoOptionService->update($blog, $payload);
            return $blog->refresh();
        });
    }
}
