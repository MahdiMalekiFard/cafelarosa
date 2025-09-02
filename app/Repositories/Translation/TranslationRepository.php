<?php

declare(strict_types=1);

namespace App\Repositories\Translation;

use App\Filters\FuzzyFilter;
use App\Models\Translation;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TranslationRepository extends BaseRepository implements TranslationRepositoryInterface
{
    public function __construct(Translation $model)
    {
        parent::__construct($model);
    }


    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(Translation::query())
                           ->with([])
                           ->defaultSort('-id')
                           ->allowedFilters([
                               AllowedFilter::custom('search', new FuzzyFilter(['value'])),
                               AllowedFilter::custom('a_search', new AdvanceFilter),
                           ]);
    }
}
