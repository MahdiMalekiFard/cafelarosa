<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\City\DeleteCityAction;
use App\Actions\City\StoreCityAction;
use App\Actions\City\UpdateCityAction;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(City::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.city.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.city.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCityRequest $request
     *
     * @return mixed
     */
    public function store(StoreCityRequest $request)
    {
        StoreCityAction::run($request->validated());
        return redirect(route('admin.city.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('city.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return view('admin.pages.city.show',compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(City $city)
    {
        return view('admin.pages.city.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCityRequest $request
     * @param City              $city
     *
     * @return mixed
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        UpdateCityAction::run($city,$request->validated());
        return redirect(route('admin.city.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('city.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     *
     * @return mixed
     */
    public function destroy(City $city)
    {
        DeleteCityAction::run($city);
        return redirect(route('admin.city.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('city.model')]));
    }
}
