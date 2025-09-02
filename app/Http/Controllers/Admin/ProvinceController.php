<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Province\DeleteProvinceAction;
use App\Actions\Province\StoreProvinceAction;
use App\Actions\Province\UpdateProvinceAction;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Models\Province;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Province::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.province.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.province.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.province.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProvinceRequest $request
     *
     * @return mixed
     */
    public function store(StoreProvinceRequest $request)
    {
        StoreProvinceAction::run($request->validated());
        return redirect(route('admin.province.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('province.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
        return view('admin.pages.province.show',compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Province $province
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Province $province)
    {
        return view('admin.pages.province.edit',compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProvinceRequest $request
     * @param Province              $province
     *
     * @return mixed
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {
        UpdateProvinceAction::run($province,$request->validated());
        return redirect(route('admin.province.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('province.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Province $province
     *
     * @return mixed
     */
    public function destroy(Province $province)
    {
        DeleteProvinceAction::run($province);
        return redirect(route('admin.province.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('province.model')]));
    }
}
