<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\MenuItem\DeleteMenuItemAction;
use App\Actions\MenuItem\StoreMenuItemAction;
use App\Actions\MenuItem\ToggleMenuItemAction;
use App\Actions\MenuItem\UpdateMenuItemAction;
use App\Enums\BooleanEnum;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use App\Yajra\Column\ActionColumn;
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

class MenuItemController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request, AdvancedSearchFieldsService $searchFieldsService)
    {
        if ($request->ajax()) {
            return Datatables::of(MenuItem::query())
                             ->addIndexColumn()
                             ->addColumn('actions', new ActionColumn('admin.pages.menuItem.index_options'))
                             ->addColumn('title', new TitleColumn)
                             ->addColumn('normal_price', fn($row) => $row->normal_price)
                             ->addColumn('special_price', fn($row) => $row->special_price)
                             ->filterColumn('title', new TitleFilter)
                             ->addColumn('published', new PublishedColumn)
                             ->addColumn('created_at', new CreatedAtColumn)
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.menuItem.index', [
//            'filters' => $searchFieldsService->generate(MenuItem::class),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::query()->where('published', BooleanEnum::ENABLE)->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->title];
        });

        return view('admin.pages.menuItem.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMenuItemRequest $request
     *
     * @return mixed
     */
    public function store(StoreMenuItemRequest $request)
    {
        StoreMenuItemAction::run($request->validated());
        return redirect(route('admin.menu-item.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('menuItem.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        return view('admin.pages.menuItem.show', compact('menuItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MenuItem $menuItem
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(MenuItem $menuItem)
    {
        $menus = Menu::query()->where('published', BooleanEnum::ENABLE)->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->title];
        });

        return view('admin.pages.menuItem.edit', compact('menuItem', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMenuItemRequest $request
     * @param MenuItem              $menuItem
     *
     * @return mixed
     */
    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem)
    {
        UpdateMenuItemAction::run($menuItem, $request->validated());
        return redirect(route('admin.menu-item.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('menuItem.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MenuItem $menuItem
     *
     * @return mixed
     */
    public function destroy(MenuItem $menuItem)
    {
        DeleteMenuItemAction::run($menuItem);
        return redirect(route('admin.menu-item.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('menuItem.model')]));
    }

    public function toggle(MenuItem $menuItem)
    {
        ToggleMenuItemAction::run($menuItem);
        return redirect(route('admin.menu-item.index'))->withToastSuccess(trans('general.toggle_success', ['model' => trans('menuItem.model')]));
    }
}
