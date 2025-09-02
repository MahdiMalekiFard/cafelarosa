<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Country\DeleteCountryAction;
use App\Actions\Country\StoreCountryAction;
use App\Actions\Country\UpdateCountryAction;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Country::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.country.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.country.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCountryRequest $request
     *
     * @return mixed
     */
    public function store(StoreCountryRequest $request)
    {
        StoreCountryAction::run($request->validated());
        return redirect(route('admin.country.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('country.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return view('admin.pages.country.show',compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Country $country)
    {
        return view('admin.pages.country.edit',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCountryRequest $request
     * @param Country              $country
     *
     * @return mixed
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        UpdateCountryAction::run($country,$request->validated());
        return redirect(route('admin.country.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('country.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     *
     * @return mixed
     */
    public function destroy(Country $country)
    {
        DeleteCountryAction::run($country);
        return redirect(route('admin.country.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('country.model')]));
    }
}
