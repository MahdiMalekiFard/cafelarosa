<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StoreUserAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly ProfileRepositoryInterface $profileRepository
    )
    {
    }

    /**
     * @param array{title:string,description:string} $payload
     * @return User
     * @throws Throwable
     */
    public function handle(array $payload): User
    {
        return DB::transaction(function () use ($payload) {
            $user = $this->repository->store($payload);
            $this->profileRepository->store([
                'user_id' => $user->id,
            ]);

            return $user->refresh();
        });
    }
}
