<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages;

use App\Services\File\FileService;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class StaticContent extends Component
{
    use WithFileUploads;

    public string         $message;
    public                $image;
    protected FileService $fileService;

    public array $about_us = [
        'da' => [
            'value' => '',
            'title' => '',
        ],
        'en' => [
            'value' => '',
            'title' => '',
        ],
    ];

    public function __construct()
    {
        $this->fileService = resolve(FileService::class);
    }

    public function mount(): void
    {
        $this->about_us['da']['title'] = \App\Models\StaticContent::where('key', 'about_us')->where('locale', 'da')->first()?->title;
        $this->about_us['da']['value'] = \App\Models\StaticContent::where('key', 'about_us')->where('locale', 'da')->first()?->value;

        $this->about_us['en']['title'] = \App\Models\StaticContent::where('key', 'about_us')->where('locale', 'en')->first()?->title;
        $this->about_us['en']['value'] = \App\Models\StaticContent::where('key', 'about_us')->where('locale', 'en')->first()?->value;
    }

    public function saveAboutUs(): void
    {
        $this->message = '';

        $rules = [
            'about_us.da.title' => 'required|string|max:255',
            'about_us.da.value' => 'required|string',
            'about_us.en.title' => 'required|string|max:255',
            'about_us.en.value' => 'required|string',
        ];

        if (!static_content_object('about_us')?->hasMedia('image')) {
            // No uploaded file and no existing image, require upload
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        } else {
            // A new file is being uploaded
            $rules['image'] = 'nullable|mimes:jpeg,png,jpg|max:2048';
        }

        $payload = $this->validate($rules, attributes: [
            'about_us.*' => 'مقدار',
        ]);

        \App\Models\StaticContent::updateOrCreate([
            'key'    => 'about_us',
            'locale' => 'da',
        ], [
            'title' => $this->about_us['da']['title'],
            'value' => $this->about_us['da']['value'],
        ]);
        \App\Models\StaticContent::updateOrCreate([
            'key'    => 'about_us',
            'locale' => 'en',
        ], [
            'title' => $this->about_us['en']['title'],
            'value' => $this->about_us['en']['value'],
        ]);

        $currentModel = \App\Models\StaticContent::where('key', 'about_us')->where('locale', 'en')?->first();
        $danishModel = \App\Models\StaticContent::where('key', 'about_us')->where('locale', 'da')?->first();

        $this->fileService->addFile($currentModel, Arr::get($payload, 'image'), save: true);
        $this->fileService->addFile($danishModel, Arr::get($payload, 'image'));


        $this->message = 'مقادیر با موفقیت ذخیره شدند.';
    }

    public function render()
    {
        return view('livewire.admin.pages.static-content');
    }
}
