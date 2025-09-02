<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Locality\DeleteLocalityAction;
use App\Actions\Locality\StoreLocalityAction;
use App\Actions\Locality\UpdateLocalityAction;
use App\Http\Requests\StoreLocalityRequest;
use App\Http\Requests\UpdateLocalityRequest;
use App\Models\Locality;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocalityController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Locality::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.locality.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.locality.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.locality.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLocalityRequest $request
     *
     * @return mixed
     */
    public function store(StoreLocalityRequest $request)
    {
        StoreLocalityAction::run($request->validated());
        return redirect(route('admin.locality.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('locality.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Locality $locality)
    {
        return view('admin.pages.locality.show',compact('locality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Locality $locality
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Locality $locality)
    {
        return view('admin.pages.locality.edit',compact('locality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLocalityRequest $request
     * @param Locality              $locality
     *
     * @return mixed
     */
    public function update(UpdateLocalityRequest $request, Locality $locality)
    {
        UpdateLocalityAction::run($locality,$request->validated());
        return redirect(route('admin.locality.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('locality.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Locality $locality
     *
     * @return mixed
     */
    public function destroy(Locality $locality)
    {
        DeleteLocalityAction::run($locality);
        return redirect(route('admin.locality.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('locality.model')]));
    }
}
