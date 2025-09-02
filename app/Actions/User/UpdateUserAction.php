<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class UpdateUserAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepositoryInterface $repository,
    )
    {
    }


    /**
     * @param User                                          $user
     * @param array{name:string,mobile:string,email:string} $payload
     * @return User
     * @throws Throwable
     */
    public function handle(User $user, array $payload): User
    {
        return DB::transaction(function () use ($user, $payload) {
            $this->repository->update($user, $payload);

            return $user->refresh();
        });
    }
}
