<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Area\DeleteAreaAction;
use App\Actions\Area\StoreAreaAction;
use App\Actions\Area\UpdateAreaAction;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Area::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.area.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.area.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.area.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAreaRequest $request
     *
     * @return mixed
     */
    public function store(StoreAreaRequest $request)
    {
        StoreAreaAction::run($request->validated());
        return redirect(route('admin.area.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('area.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        return view('admin.pages.area.show',compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Area $area
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Area $area)
    {
        return view('admin.pages.area.edit',compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAreaRequest $request
     * @param Area              $area
     *
     * @return mixed
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        UpdateAreaAction::run($area,$request->validated());
        return redirect(route('admin.area.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('area.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Area $area
     *
     * @return mixed
     */
    public function destroy(Area $area)
    {
        DeleteAreaAction::run($area);
        return redirect(route('admin.area.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('area.model')]));
    }
}
