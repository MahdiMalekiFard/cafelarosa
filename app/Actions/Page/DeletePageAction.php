<?php

namespace App\Actions\Page;

use App\Models\Page;
use App\Repositories\Page\PageRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeletePageAction
{
    use AsAction;

    public function __construct(public readonly PageRepositoryInterface $repository)
    {
    }

    public function handle(Page $page): bool
    {
        return DB::transaction(function () use ($page) {
            return $this->repository->delete($page);
        });
    }
}
