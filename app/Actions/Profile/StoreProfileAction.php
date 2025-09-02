<?php

namespace App\Actions\Profile;

use App\Models\Profile;
use App\Repositories\Profile\ProfileRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StoreProfileAction
{
    use AsAction;

    public function __construct(
        private readonly ProfileRepositoryInterface $repository,
    )
    {
    }

    /**
     * @param array{title:string,description:string} $payload
     * @return Profile
     * @throws Throwable
     */
    public function handle(array $payload): Profile
    {
        return DB::transaction(function () use ($payload) {
            /** @var Profile $model */
            $model = $this->repository->store($payload);

            return $model->refresh();
        });
    }
}
