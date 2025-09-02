<?php

namespace App\Actions\Opinion;

use App\Models\Opinion;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class StoreOpinionAction
{
    use AsAction;

    public function __construct(
        private readonly OpinionRepositoryInterface $repository,
    )
    {
    }

    /**
     * @param array{
     *     subject:string,
     *     comment:string,
     *     user_name:string,
     *     company:string,
     *     ordering:string
     * } $payload
     * @return Opinion
     * @throws Throwable
     */
    public function handle(array $payload): Opinion
    {
        return DB::transaction(function () use ($payload) {
            /** @var Opinion $model */
            $model = $this->repository->store($payload);

            return $model->refresh();
        });
    }
}
