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

class StoreSliderAction
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
     * @param array{title:string,description:string} $payload
     * @return Slider
     * @throws Throwable
     */
    public function handle(array $payload): Slider
    {
        return DB::transaction(function () use ($payload) {
            /** @var Slider $model */
            $model = $this->repository->store(Arr::only($payload, ['published']));
            $this->syncTranslationAction->handle($model, Arr::only($payload, ['title', 'description']));
            $this->fileService->addMedia($model);

            return $model->refresh();
        });
    }
}
