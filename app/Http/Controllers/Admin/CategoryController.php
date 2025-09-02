<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\StoreCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Enums\CategoryTypeEnum;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Yajra\Column\CreatedAtColumn;
use App\Yajra\Column\PublishedColumn;
use App\Yajra\Column\TitleColumn;
use App\Yajra\Filter\TitleFilter;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Category::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.category.index_options', ['row' => $row]);
                             })
                             ->addColumn('title', new TitleColumn)
                             ->addColumn('published', new PublishedColumn)
                             ->filterColumn('title', new TitleFilter)
                             ->addColumn('created_at', new CreatedAtColumn)
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     *
     * @return mixed
     */
    public function store(StoreCategoryRequest $request)
    {
        StoreCategoryAction::run($request->validated());
        return redirect(route('admin.category.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('category.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.pages.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Category $category)
    {
        return view('admin.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category              $category
     *
     * @return mixed
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        UpdateCategoryAction::run($category, $request->validated());
        return redirect(route('admin.category.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('category.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @return mixed
     */
    public function destroy(Category $category)
    {
        DeleteCategoryAction::run($category);
        return redirect(route('admin.category.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('category.model')]));
    }
}
