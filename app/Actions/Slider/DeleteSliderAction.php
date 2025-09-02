<?php

namespace App\Actions\Slider;

use App\Models\Slider;
use App\Repositories\Slider\SliderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteSliderAction
{
    use AsAction;

    public function __construct(public readonly SliderRepositoryInterface $repository)
    {
    }

    public function handle(Slider $slider): bool
    {
        return DB::transaction(function () use ($slider) {
            return $this->repository->delete($slider);
        });
    }
}
