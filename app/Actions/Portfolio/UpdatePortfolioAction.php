<?php

namespace App\Actions\Portfolio;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Portfolio;
use App\Repositories\Portfolio\PortfolioRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class UpdatePortfolioAction
{
    use AsAction;

    public function __construct(
        private readonly PortfolioRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
        private readonly FileService $fileService,
    )
    {
    }


    /**
     * @param Portfolio $portfolio
     * @param array{
     *     title:string,
     *     slug:string,
     *     description:string,
     *     body:string,
     *     image:string,
     *     categories_id:array<integer>,
     *     tags_id:array<integer>,
     *     seo_title:string,
     *     seo_description:string,
     *     published:boolean,
     * }                $payload
     * @return Portfolio
     * @throws Throwable
     */
    public function handle(Portfolio $portfolio, array $payload): Portfolio
    {
        return DB::transaction(function () use ($portfolio, $payload) {
            $this->repository->update($portfolio, Arr::only($payload, ['published', 'seo_title', 'seo_description', 'slug']));
            $this->syncTranslationAction->handle($portfolio, Arr::only($payload, ['title', 'description', 'body']));
            $portfolio->categories()->sync(Arr::get($payload, 'categories_id', []));
            $portfolio->tags()->sync(Arr::get($payload, 'tags_id', []));
            $this->fileService->addMedia($portfolio);

            return $portfolio->refresh();
        });
    }
}
