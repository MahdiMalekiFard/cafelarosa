<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Shared;

use App\Actions\Translation\SyncTranslationAction;
use App\Helpers\Utils;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;
use Livewire\Component;

class TranslationGenerator extends Component
{
    public string $model;
    public int $id;
    public string $locale;
    public array $fields = [];
    public Model $eloquent;

    public function mount(string $model, int $id, string $locale): void
    {
        $this->model  = $model;
        $this->id     = $id;
        $this->locale = $locale;
        /** @var Blog $eloquent */
        $eloquent = Utils::getEloquent($this->model);

        /** @var BlogRepositoryInterface $repository */
        $repository = Utils::getRepository($eloquent);

        $this->eloquent = $repository->find($this->id);

        foreach ($this->eloquent->translatable as $item) {
            $this->fields[] = [
                'name'  => $item,
                'label' => trans('validation.attributes.' . $item),
                'value' => $this->eloquent->rowTranslations()->where('locale', $this->locale)->where('key', $item)->first()?->value,
            ];
        }
    }

    public function saveTranslation()
    {
        $this->validate([
            'fields'         => 'required|array',
            'fields.*.value' => 'required|string',
        ], [
            'fields.*.value' => 'تکمیل این گزینه الزامی است',
        ]);

        $payload           = array_column($this->fields, 'value', 'name');
        $payload['locale'] = $this->locale;
        SyncTranslationAction::run($this->eloquent, $payload);
        return $this->redirect(route('admin.'.$this->model.'.index'));
    }

    public function render(): View
    {
        return view('livewire.admin.shared.translation-generator')
            ->layout('livewire.admin.master', ['title' => trans('translation.model'), 'stack' => []]);
    }
}
