<?php

declare(strict_types=1);

namespace App\Repositories\Slider;

use App\Filters\FuzzyFilter;
use App\Models\Slider;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SliderRepository extends BaseRepository implements SliderRepositoryInterface
{
    public function __construct(Slider $model)
    {
        parent::__construct($model);
    }


    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(Slider::query())
                           ->with(Arr::get($payload, 'with', []))
                           ->when($limit = Arr::get($payload, 'limit', false), fn($query) => $query->limit($limit))
                           ->when(!auth()->check() || count(auth()->user()->getPermissionNames()) === 0, function ($query) {
                               return $query->where('published', true)->whereJsonContains('languages', app()->getLocale());
                           })
                           ->defaultSort(Arr::get($payload, 'sort', '-id'))
                           ->allowedSorts(['id', 'created_at', 'updated_at'])
                           ->allowedFilters([
                               AllowedFilter::custom('search', new FuzzyFilter(['translations' => ['value']]))->default(Arr::get($payload, 'search'))->nullable(false),
                               AllowedFilter::custom('a_search', new AdvanceFilter())->default(Arr::get($payload, 'a_search', []))->nullable(false),
                           ]);
    }

    public function extra(array $payload = []): array
    {
        return [
            'default_sort' => '-id',
            'sorts'        => ['id', 'created_at', 'updated_at'],
        ];
    }

}
