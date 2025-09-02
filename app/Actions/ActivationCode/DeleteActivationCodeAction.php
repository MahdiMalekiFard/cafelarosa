<?php

namespace App\Actions\ActivationCode;

use App\Models\ActivationCode;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteActivationCodeAction
{
    use AsAction;

    public function __construct(public readonly ActivationCodeRepositoryInterface $repository)
    {
    }

    public function handle(ActivationCode $activationCode): bool
    {
        return DB::transaction(function () use ($activationCode) {
            return $this->repository->delete($activationCode);
        });
    }
}
