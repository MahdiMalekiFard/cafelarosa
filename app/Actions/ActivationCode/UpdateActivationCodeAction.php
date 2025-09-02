<?php

namespace App\Actions\ActivationCode;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\ActivationCode;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateActivationCodeAction
{
    use AsAction;

    public function __construct(
        private readonly ActivationCodeRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
    ) {}


    /**
     * @param ActivationCode                                          $activationCode
     * @param array{title:string,description:string}             $payload
     * @return ActivationCode
     */
    public function handle(ActivationCode $activationCode, array $payload): ActivationCode
    {
        return DB::transaction(function () use ($activationCode, $payload) {
            $this->repository->update($activationCode, $payload);
            $this->syncTranslationAction->handle($activationCode, Arr::only($payload, ['title', 'description', 'body']));

            return $activationCode->refresh();
        });
    }
}
