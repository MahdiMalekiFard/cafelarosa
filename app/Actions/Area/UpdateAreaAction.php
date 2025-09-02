<?php

namespace App\Actions\Area;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Area;
use App\Repositories\Area\AreaRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateAreaAction
{
    use AsAction;

    public function __construct(
        private readonly AreaRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param Area                                          $area
     * @param array{title:string,description:string}             $payload
     * @return Area
     */
    public function handle(Area $area, array $payload): Area
    {
        return DB::transaction(function () use ($area, $payload) {
            $this->repository->update($area, $payload);
            $this->syncTranslationAction->handle($area, Arr::only($payload, ['title', 'description', 'body']));

            return $area->refresh();
        });
    }
}
