<?php

namespace App\Actions\Category;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StoreCategoryAction
{
    use AsAction;

    public function __construct(
        private readonly CategoryRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    )
    {
    }

    /**
     * @param array{
     *     title:string,
     *     description:string,
     *     body:string,
     *     published:boolean,
     *     slug:string,
     *     seo_title:string,
     *     seo_description:string,
     * } $payload
     * @return Category
     * @throws Throwable
     */
    public function handle(array $payload): Category
    {
        return DB::transaction(function () use ($payload) {
            /** @var Category $model */
            $model = $this->repository->store(Arr::only($payload, [
                'published', 'type', 'slug', 'seo_title', 'seo_description',
            ]));
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));

            return $model->refresh();
        });
    }
}
