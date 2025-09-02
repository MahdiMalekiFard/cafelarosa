<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Blog\ToggleBlogAction;
use App\Actions\Portfolio\DeletePortfolioAction;
use App\Actions\Portfolio\StorePortfolioAction;
use App\Actions\Portfolio\UpdatePortfolioAction;
use App\Enums\BooleanEnum;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\Category;
use App\Models\Portfolio;
use App\Repositories\Portfolio\PortfolioRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use App\Yajra\Column\ActionColumn;
use App\Yajra\Column\CategoriesTitleColumn;
use App\Yajra\Column\PublishedColumn;
use App\Yajra\Column\TitleColumn;
use App\Yajra\Filter\TitleFilter;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PortfolioController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request, AdvancedSearchFieldsService $searchFieldsService)
    {
        if ($request->ajax()) {
            return Datatables::of(Portfolio::query())
                             ->addIndexColumn()
                             ->addColumn('title', new TitleColumn)
                             ->addColumn('actions', new ActionColumn('admin.pages.portfolio.index_options'))
                             ->filterColumn('title', new TitleFilter)
                             ->addColumn('published', new PublishedColumn)
                             ->addColumn('categories_title', new CategoriesTitleColumn)
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.portfolio.index', [
            'filters' => $searchFieldsService->generate(Portfolio::class),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePortfolioRequest $request
     *
     * @return mixed
     */
    public function store(StorePortfolioRequest $request)
    {
        StorePortfolioAction::run($request->validated());
        return redirect(route('admin.portfolio.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('portfolio.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        return view('admin.pages.portfolio.show', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Portfolio $portfolio
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Portfolio $portfolio)
    {
        $selectedCategories = $portfolio->categories->map(function (Category $category) {
            return [
                'id'    => $category->id,
                'value' => $category->title,
            ];
        })->toArray();

        $selectedTags = $portfolio->tags->map(fn($tag) => [
            'id'    => $tag->id, // @phpstan-ignore-line
            'value' => $tag->name, // @phpstan-ignore-line
        ])->toArray();

        return view('admin.pages.portfolio.edit', compact('portfolio', 'selectedCategories', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePortfolioRequest $request
     * @param Portfolio              $portfolio
     *
     * @return mixed
     */
    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
        UpdatePortfolioAction::run($portfolio, $request->validated());
        return redirect(route('admin.portfolio.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('portfolio.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Portfolio $portfolio
     *
     * @return mixed
     */
    public function destroy(Portfolio $portfolio)
    {
        DeletePortfolioAction::run($portfolio);
        return redirect(route('admin.portfolio.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('portfolio.model')]));
    }

    public function toggle(Portfolio $portfolio)
    {
        ToggleBlogAction::run($portfolio);
        return redirect(route('admin.portfolio.index'))->withToastSuccess(trans('general.toggle_success', ['model' => trans('portfolio.model')]));
    }

    public function portfolioList(PortfolioRepositoryInterface $repository)
    {
        $portfolios = $repository->query([
            'published' => BooleanEnum::ENABLE,
        ])->get();
        return view('web.pages.portfolio-list', compact('portfolios'));
    }

    public function portfolioDetail(string $locale, Portfolio $portfolio)
    {
        return view('web.pages.portfolio-detail', compact('portfolio'));
    }
}
