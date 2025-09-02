<?php

declare(strict_types=1);

namespace App\Repositories\Blog;

use App\Filters\FuzzyFilter;
use App\Models\Blog;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }


    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(Blog::query())
                           ->with(Arr::get($payload, 'with', []))
                           ->defaultSort(Arr::get($payload, 'sort', '-id'))
                           ->allowedSorts(['id', 'published', 'created_at', 'updated_at'])
                           ->when($limit = Arr::get($payload, 'limit', false), fn($query) => $query->limit($limit))
                           ->when(!auth()->check() || count(auth()->user()->getPermissionNames()) === 0, function ($query) {
                               return $query->where('published', true)->whereJsonContains('languages', app()->getLocale());
                           })
                           ->allowedFilters([
                               AllowedFilter::callback('category_id', function (Builder $query, $value) {
                                   $query->whereHas('categories', function ($q) use ($value) {
                                       $q->where('id', $value);
                                   });
                               })->default(Arr::get($payload, 'filter.category_id'))->nullable(false),
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
