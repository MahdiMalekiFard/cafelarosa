<?php

namespace App\Actions\Category;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class UpdateCategoryAction
{
    use AsAction;

    public function __construct(
        private readonly CategoryRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    )
    {
    }


    /**
     * @param Category                               $category
     * @param array{title:string,description:string} $payload
     * @return Category
     * @throws Throwable
     */
    public function handle(Category $category, array $payload): Category
    {
        return DB::transaction(function () use ($category, $payload) {
            $this->repository->update($category, Arr::only($payload, [
                'published', 'type', 'slug', 'seo_title', 'seo_description',
            ]));
            $this->syncTranslationAction->handle($category, Arr::only($payload, ['title', 'description', 'body']));

            return $category->refresh();
        });
    }
}
