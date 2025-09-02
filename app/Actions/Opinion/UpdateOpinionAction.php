<?php

namespace App\Actions\Opinion;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Opinion;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateOpinionAction
{
    use AsAction;

    public function __construct(
        private readonly OpinionRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param Opinion                                          $opinion
     * @param array{title:string,description:string}             $payload
     * @return Opinion
     */
    public function handle(Opinion $opinion, array $payload): Opinion
    {
        return DB::transaction(function () use ($opinion, $payload) {
            $this->repository->update($opinion, $payload);
            $this->syncTranslationAction->handle($opinion, Arr::only($payload, ['title', 'description', 'body']));

            return $opinion->refresh();
        });
    }
}
