<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Setting\DeleteSettingAction;
use App\Actions\Setting\StoreSettingAction;
use App\Actions\Setting\UpdateSettingAction;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Setting::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.setting.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.setting.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSettingRequest $request
     *
     * @return mixed
     */
    public function store(StoreSettingRequest $request)
    {
        StoreSettingAction::run($request->validated());
        return redirect(route('admin.setting.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('setting.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return view('admin.pages.setting.show',compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Setting $setting
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Setting $setting)
    {
        return view('admin.pages.setting.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSettingRequest $request
     * @param Setting              $setting
     *
     * @return mixed
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        UpdateSettingAction::run($setting,$request->validated());
        return redirect(route('admin.setting.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('setting.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Setting $setting
     *
     * @return mixed
     */
    public function destroy(Setting $setting)
    {
        DeleteSettingAction::run($setting);
        return redirect(route('admin.setting.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('setting.model')]));
    }
}
