<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Blog\DeleteBlogAction;
use App\Actions\Blog\StoreBlogAction;
use App\Actions\Blog\ToggleBlogAction;
use App\Actions\Blog\UpdateBlogAction;
use App\Enums\BooleanEnum;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use App\Yajra\Column\ActionColumn;
use App\Yajra\Column\CategoriesTitleColumn;
use App\Yajra\Column\CreatedAtColumn;
use App\Yajra\Column\PublishedColumn;
use App\Yajra\Column\TitleColumn;
use App\Yajra\Filter\CategoriesTitleFilter;
use App\Yajra\Filter\TitleFilter;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request, AdvancedSearchFieldsService $searchFieldsService, BlogRepositoryInterface $repository)
    {
        if ($request->ajax()) {
            return Datatables::of(Blog::query())
                             ->addIndexColumn()
                             ->addColumn('actions', new ActionColumn('admin.pages.blog.index_options'))
                             ->addColumn('title', new TitleColumn)
                             ->addColumn('published', new PublishedColumn)
                             ->filterColumn('title', new TitleFilter)
                             ->addColumn('categories_title', new CategoriesTitleColumn)
                             ->filterColumn('categories_title', new CategoriesTitleFilter)
                             ->addColumn('created_at', new CreatedAtColumn)
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.blog.index', [
            'filters' => $searchFieldsService->generate(Blog::class),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBlogRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogRequest $request)
    {
        StoreBlogAction::run($request->validated());
        return redirect(route('admin.blog.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('blog.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.pages.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Blog $blog
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Blog $blog)
    {
        $selectedCategories = $blog->categories->map(function (Category $category) {
            return [
                'id'    => $category->id,
                'value' => $category->title,
            ];
        })->toArray();

        $selectedTags = $blog->tags->map(fn($tag) => [
            'id'    => $tag->id, // @phpstan-ignore-line
            'value' => $tag->name, // @phpstan-ignore-line
        ])->toArray();

        return view('admin.pages.blog.edit', compact('blog', 'selectedCategories', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBlogRequest $request
     * @param Blog              $blog
     *
     * @return mixed
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        UpdateBlogAction::run($blog, $request->validated());
        return redirect(route('admin.blog.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('blog.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     *
     * @return mixed
     */
    public function destroy(Blog $blog)
    {
        DeleteBlogAction::run($blog);
        return redirect(route('admin.blog.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('blog.model')]));
    }

    public function toggle(Blog $blog)
    {
        ToggleBlogAction::run($blog);
        return redirect(route('admin.blog.index'))->withToastSuccess(trans('general.toggle_success', ['model' => trans('blog.model')]));
    }

    public function blogList(BlogRepositoryInterface $repository)
    {
        $blogs = $repository->query()->where('published', BooleanEnum::ENABLE)->get();
        return view('web.pages.blog-list', compact('blogs'));
    }

    public function blogDetail(string $locale, Blog $blog)
    {
        return view('web.pages.blog-detail', ['blog' => $blog]);
    }
}
