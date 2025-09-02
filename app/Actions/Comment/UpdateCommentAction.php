<?php

namespace App\Actions\Comment;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCommentAction
{
    use AsAction;

    public function __construct(
        private readonly CommentRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param Comment                                          $comment
     * @param array{title:string,description:string}             $payload
     * @return Comment
     */
    public function handle(Comment $comment, array $payload): Comment
    {
        return DB::transaction(function () use ($comment, $payload) {
            $this->repository->update($comment, $payload);
            $this->syncTranslationAction->handle($comment, Arr::only($payload, ['title', 'description', 'body']));

            return $comment->refresh();
        });
    }
}
