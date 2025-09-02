<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Category;
// use App\Models\Country;
// use App\Models\Province;
use App\Models\Country;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class SharedDataController extends BaseWebController
{
    public function dropdownUsers(Request $request): JsonResponse
    {
        $query = User::select('id', 'name', 'mobile', 'email');
        if ($search = $request->input('search')) {
            $query = $query
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        }
        $query = $query->limit(20)->get()->map(function ($item) {
            $item['text'] = $item->name . '[ tell:' . $item->mobile . ' , email:' . $item->email . ' ]';

            return $item;
        });

        return response()->json(['items' => $query]);
    }

    public function dropdownCategory(Request $request, string $type): JsonResponse
    {
        $query = Category::with(['translations'])
            ->where('type', $type);
        if ($search = $request->input('search')) {
            $query = $query
                ->where('slug', 'LIKE', '%' . $search . '%')
                ->orWhereHas('translations', function ($query) use ($search) {
                    $query->where('key', 'title')
                        ->where('value', 'LIKE', '%' . $search . '%');
                });
        }
        $query = $query->limit(20)->get()->map(function (Category $item) {
            $item['text'] = $item->title;

            return $item;
        });

        return response()->json(['items' => $query]);
    }

    public function dropdownTag(Request $request): JsonResponse
    {
        $query = Tag::where('type', $request->input('type'));
        if ($search = $request->input('search')) {
            $query = $query
                ->where('name->' . app()->getLocale(), 'LIKE', '%' . $search . '%');
        }
        $query = $query->limit(20)->get()->map(function (Tag $item) {
            $item['text'] = $item->name;

            return $item;
        });

        return response()->json(['items' => $query]);
    }

    public function dropdownCountry(Request $request): JsonResponse
    {
        $query = Country::with(['translations']);
        if ($search = $request->input('search')) {
            $query = $query
                ->whereHas('translations', function ($query) use ($search) {
                    $query->where('key', 'title')
                        ->where('value', 'LIKE', '%' . $search . '%');
                });
        }
        $query = $query->limit(20)->get()->map(function ($item) {
            $item['text'] = $item->title;

            return $item;
        });

        return response()->json(['items' => $query]);
    }

    public function dropdownProvince(Request $request): JsonResponse
    {
        $query = Province::with(['translations']);
        if ($search = $request->input('search')) {
            $query = $query
                ->whereHas('translations', function ($query) use ($search) {
                    $query->where('key', 'title')
                        ->where('value', 'LIKE', '%' . $search . '%');
                });
        }
        $query = $query->limit(20)->get()->map(function ($item) {
            $item['text'] = $item->title;

            return $item;
        });

        return response()->json(['items' => $query]);
    }
}
