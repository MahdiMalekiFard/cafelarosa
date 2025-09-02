<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Page\DeletePageAction;
use App\Actions\Page\StorePageAction;
use App\Actions\Page\UpdatePageAction;
use App\Enums\ArtGalleryTypeEnum;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use App\Repositories\Page\PageRepositoryInterface;
use App\Repositories\ArtGallery\ArtGalleryRepositoryInterface;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use App\Enums\PageTypeEnum;
use App\Enums\BooleanEnum;
use App\Yajra\Column\ActionColumn;
use App\Yajra\Column\TitleColumn;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request, AdvancedSearchFieldsService $searchFieldsService)
    {
        if ($request->ajax()) {
            return Datatables::of(Page::query())
                             ->addIndexColumn()
                             ->addColumn('type', fn($row) => $row->type->title())
                             ->addColumn('title', new TitleColumn)
                             ->addColumn('actions', new ActionColumn('admin.pages.page.index_options'))
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.page.index', [
            'filters' => $searchFieldsService->generate(Page::class),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Page $page)
    {
        return view('admin.pages.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePageRequest $request
     * @param Page              $page
     *
     * @return mixed
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        UpdatePageAction::run($page, $request->validated());
        return redirect(route('admin.page.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('page.model')]));
    }

    public function about(PageRepositoryInterface $repository)
    {
        $about = $repository->query()->where('type', PageTypeEnum::ABOUT_US)->first();
        $opinions = resolve(OpinionRepositoryInterface::class)->get(['limit' => 4, 'published' => BooleanEnum::ENABLE]);
        $artGalleries = resolve(ArtGalleryRepositoryInterface::class)->query()->get();

        return view('web.pages.about', compact('about', 'opinions', 'artGalleries'));
    }
}
