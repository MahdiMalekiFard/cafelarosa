<?php

namespace App\Actions\Locality;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Locality;
use App\Repositories\Locality\LocalityRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateLocalityAction
{
    use AsAction;

    public function __construct(
        private readonly LocalityRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param Locality                                          $locality
     * @param array{title:string,description:string}             $payload
     * @return Locality
     */
    public function handle(Locality $locality, array $payload): Locality
    {
        return DB::transaction(function () use ($locality, $payload) {
            $this->repository->update($locality, $payload);
            $this->syncTranslationAction->handle($locality, Arr::only($payload, ['title', 'description', 'body']));

            return $locality->refresh();
        });
    }
}
