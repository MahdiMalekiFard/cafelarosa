<?php

declare(strict_types=1);

namespace App\Services\File;

use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FileService
{
    public static function dropzoneImagePathGenerator(): string
    {
        $year = Carbon::now()->year;

        return "uploads/images/dropzone/{$year}/";
    }

    public function addMedia($model, $requestImageName = 'image', $collection = 'image'): void
    {
        if (request()->hasFile($requestImageName)) {
            $model->addMediaFromRequest($requestImageName)->toMediaCollection($collection);
        }
    }

    public function addFile($model, $file, $collection = 'image', $save = false): void
    {
        if ($file) {
            if ($save) {
                $model->addMedia($file)
                      ->preservingOriginal()
                      ->toMediaCollection($collection);
            } else {
                $model->addMedia($file)
                      ->toMediaCollection($collection);
            }
        }
    }

    public function addMultipleMedia($model, $count, $requestImageCounter = 'image', $collection = 'slider'): void
    {
        for ($i = 1; $i <= $count; $i++) {
            if (request()->hasFile($requestImageCounter . $i)) {
                $model->addMediaFromRequest($requestImageCounter . $i)->toMediaCollection($collection);
            }
        }
    }

    public function updateMultipleMedia($model, $count, $imageList = [], $requestImageCounter = 'image', $collection = 'slider', $collectionNameChecker = '720'): void
    {
        $sliders = $model->getMedia($collection);
        if (count($sliders) > 0) {
            foreach ($sliders as $slider) {
                if (!in_array($slider->getUrl($collectionNameChecker), $imageList, true)) {
                    $slider->delete();
                }
            }
        }

        for ($i = 1; $i <= $count; $i++) {
            if (request()->hasFile($requestImageCounter . $i)) {
                $model->addMediaFromRequest($requestImageCounter . $i)->toMediaCollection($collection);
            }
        }
    }

    public function addFromDropzone($model, $requestImageCounter = 'documentsDropzone', $collection = 'slides'): void
    {
        foreach (request()->input($requestImageCounter, []) as $file) {
            $fullPath = public_path(self::dropzoneImagePathGenerator() . $file);
            $model->addMedia($fullPath)->toMediaCollection($collection);
        }
    }

    public function updateFromDropzone($model, $requestImageCounter = 'documentsDropzone', $collection = 'slides'): void
    {
        $submitted = request()->input($requestImageCounter, []);

        // Remove media not in the submitted list
        /** @var Media $media */
        foreach ($model->getMedia($collection) as $media) {
            if (!in_array($media->file_name, $submitted, true)) {
                $media->delete();
            }
        }

        // Get current media IDs
        $existingIds = $model->getMedia($collection)->pluck('id')->toArray();

        // Add new media
        foreach ($submitted as $value) {
            // If value is a numeric ID, skip it (already exists)
            if (is_numeric($value) && in_array((int)$value, $existingIds, true)) {
                continue;
            }

            // Otherwise it's a file name: try to attach it
            $fullPath = public_path(self::dropzoneImagePathGenerator() . $value);

            if (file_exists($fullPath)) {
                $model->addMedia($fullPath)->toMediaCollection($collection);
            }
        }
    }
}
