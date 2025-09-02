<?php

declare(strict_types=1);

namespace App\Actions\Blog;

use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class ToggleBlogAction
{
    use AsAction;

    public function __construct(private readonly BlogRepositoryInterface $repository) {}

    public function handle($blog): Blog
    {
        return DB::transaction(function () use ($blog) {
            /** @var Blog $blog */
            $blog = $this->repository->toggle($blog);

            return $blog->refresh();
        });
    }
}
