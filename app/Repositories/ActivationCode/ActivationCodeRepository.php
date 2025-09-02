<?php

declare(strict_types=1);

namespace App\Repositories\ActivationCode;

use App\Filters\FuzzyFilter;
use App\Models\ActivationCode;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ActivationCodeRepository extends BaseRepository implements ActivationCodeRepositoryInterface
{
    public function __construct(ActivationCode $model)
    {
        parent::__construct($model);
    }


    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(ActivationCode::query())
                           ->with(Arr::get($payload, 'with', []))
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
