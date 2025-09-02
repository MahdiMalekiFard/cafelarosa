<?php

namespace App\Actions\Province;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Province;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProvinceAction
{
    use AsAction;

    public function __construct(
        private readonly ProvinceRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param Province                                          $province
     * @param array{title:string,description:string}             $payload
     * @return Province
     */
    public function handle(Province $province, array $payload): Province
    {
        return DB::transaction(function () use ($province, $payload) {
            $this->repository->update($province, $payload);
            $this->syncTranslationAction->handle($province, Arr::only($payload, ['title', 'description', 'body']));

            return $province->refresh();
        });
    }
}
