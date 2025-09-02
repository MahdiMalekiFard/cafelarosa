<?php

namespace App\Actions\Slider;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Slider;
use App\Repositories\Slider\SliderRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class UpdateSliderAction
{
    use AsAction;

    public function __construct(
        private readonly SliderRepositoryInterface $repository,
        private readonly SyncTranslationAction $syncTranslationAction,
        private readonly FileService $fileService
    )
    {
    }


    /**
     * @param Slider                                 $slider
     * @param array{title:string,description:string} $payload
     * @return Slider
     * @throws Throwable
     */
    public function handle(Slider $slider, array $payload): Slider
    {
        return DB::transaction(function () use ($slider, $payload) {
            $this->repository->update($slider, $payload);
            $this->syncTranslationAction->handle($slider, Arr::only($payload, ['title', 'description', 'body']));
            $this->fileService->addMedia($slider);

            return $slider->refresh();
        });
    }
}
