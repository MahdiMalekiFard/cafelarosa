<?php

namespace App\Actions\Comment;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCommentAction
{
    use AsAction;

    public function __construct(
        private readonly CommentRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}

    /**
     * @param array{title:string,description:string}             $payload
     * @return Comment
     */
    public function handle(array $payload): Comment
    {
        return DB::transaction(function () use ($payload) {
            /** @var Comment $model */
            $model =  $this->repository->store($payload);
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));

            return $model->refresh();
        });
    }
}
