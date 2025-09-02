<?php

namespace App\Actions\ActivationCode;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\ActivationCode;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreActivationCodeAction
{
    use AsAction;

    public function __construct(
        private readonly ActivationCodeRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}

    /**
     * @param array{title:string,description:string}             $payload
     * @return ActivationCode
     */
    public function handle(array $payload): ActivationCode
    {
        return DB::transaction(function () use ($payload) {
            /** @var ActivationCode $model */
            $model =  $this->repository->store($payload);
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description', 'body']));

            return $model->refresh();
        });
    }
}
