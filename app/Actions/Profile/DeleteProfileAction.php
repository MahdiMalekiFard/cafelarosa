<?php

namespace App\Actions\Profile;

use App\Models\Profile;
use App\Repositories\Profile\ProfileRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteProfileAction
{
    use AsAction;

    public function __construct(public readonly ProfileRepositoryInterface $repository)
    {
    }

    public function handle(Profile $profile): bool
    {
        return DB::transaction(function () use ($profile) {
            return $this->repository->delete($profile);
        });
    }
}
