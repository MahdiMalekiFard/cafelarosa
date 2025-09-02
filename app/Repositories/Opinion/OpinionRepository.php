<?php

declare(strict_types=1);

namespace App\Repositories\Opinion;

use App\Filters\FuzzyFilter;
use App\Models\Opinion;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OpinionRepository extends BaseRepository implements OpinionRepositoryInterface
{
    public function __construct(Opinion $model)
    {
        parent::__construct($model);
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(Opinion::query())
                           ->with(Arr::get($payload, 'with', []))
                           ->defaultSort(Arr::get($payload, 'sort', '-id'))
                           ->allowedSorts(['id', 'created_at', 'updated_at'])
                           ->when($limit = Arr::get($payload, 'limit', false), fn($query) => $query->limit($limit))
                           ->when($published = Arr::get($payload, 'published', false), fn($query) => $query->where('published', $published))
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
