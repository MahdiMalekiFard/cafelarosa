<?php

namespace App\Repositories;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

trait CacheableRepositoryTrait
{

//    public function paginate(?int $limit = null, array $payload = []): LengthAwarePaginator|Collection|array
//    {

//    }

    public function get(array $payload = []): Collection|array
    {
        return $this->getFromCache(function ($payload) {
            return parent::get($payload);
        },$payload);
    }

    public function store(array $payload)
    {

    }

    public function update($eloquent, array $payload)
    {

    }

    public function delete($eloquent): bool
    {

    }

    public function find(mixed $value, string $field = 'id', array $selected = ['*'], bool $firstOrFail = false, array $with = [])
    {
        return $this->getFromCache(function ($value, $field, $selected, $firstOrFail, $with) {
            return parent::find($value, $field, $selected, $firstOrFail, $with);
        }, $value, $field, $selected, $firstOrFail, $with);
    }

    public function toggle($model, string $field = 'published')
    {

    }

    public function updateOrCreate(array $data, array $conditions = [])
    {

    }

    private function getFromCache(Closure $closure, ...$functionArgs): mixed
    {
        // Get the backtrace
        $method = debug_backtrace()[1]['function'];

        $cacheKey = $this->generateCacheKey($method, $functionArgs);
        $cachedValue = cache()->get($cacheKey);
        if ($cachedValue !== null) {
            return $cachedValue;
        }

        $resultClosure = function () use ($closure, $functionArgs) {
            return call_user_func_array($closure, $functionArgs);
        };
        $value = $resultClosure();

        if ($value !== null) {
            cache()->put($cacheKey, $value, 60 * 60);
        }

        return $value;
    }

    private function generateCacheKey($method, $args = null): string
    {
        /**
         * @var $request Request
         */
        $request       = app(Request::class);
        $args          = serialize($args);
        $paramsRequest = serialize($request->query());
        return sprintf('repository:%s:%s:%s:'.app()->getLocale(), class_basename(get_called_class()), $method, md5($args . $paramsRequest));
    }

    private function removeCacheByPrefix(string $prefix): void
    {
        // Get all cache keys
        $cacheKeys = cache()->getStore()->getKeys();

        // Filter keys that start with the given prefix
        $keysToRemove = array_filter($cacheKeys, function ($key) use ($prefix) {
            return strpos($key, $prefix) === 0;
        });

        // Remove the filtered keys from the cache
        foreach ($keysToRemove as $key) {
            cache()->forget($key);
        }
    }
}