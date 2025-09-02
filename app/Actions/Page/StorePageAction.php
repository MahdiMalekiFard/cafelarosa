<?php

namespace App\Actions\Page;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Page;
use App\Repositories\Page\PageRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StorePageAction
{
    use AsAction;

    public function __construct(
        private readonly PageRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    )
    {
    }

    /**
     * @param array{title:string,body:string,type:string,image:string} $payload
     * @return Page
     * @throws Throwable
     */
    public function handle(array $payload): Page
    {
        return DB::transaction(function () use ($payload) {
            /** @var Page $model */
            $model = $this->repository->store(Arr::only($payload, ['type']));
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'body']));

            return $model->refresh();
        });
    }
}
