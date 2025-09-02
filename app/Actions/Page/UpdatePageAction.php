<?php

namespace App\Actions\Page;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Page;
use App\Repositories\Page\PageRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class UpdatePageAction
{
    use AsAction;

    public function __construct(
        private readonly PageRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    )
    {
    }


    /**
     * @param Page                            $page
     * @param array{title:string,body:string} $payload
     * @return Page
     * @throws Throwable
     */
    public function handle(Page $page, array $payload): Page
    {
        return DB::transaction(function () use ($page, $payload) {
            $this->repository->update($page, $payload);
            $this->syncTranslationAction->handle($page, Arr::only($payload, ['title', 'body']));

            return $page->refresh();
        });
    }
}
