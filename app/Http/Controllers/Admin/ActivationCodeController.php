<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\ActivationCode\DeleteActivationCodeAction;
use App\Actions\ActivationCode\StoreActivationCodeAction;
use App\Actions\ActivationCode\UpdateActivationCodeAction;
use App\Http\Requests\StoreActivationCodeRequest;
use App\Http\Requests\UpdateActivationCodeRequest;
use App\Models\ActivationCode;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ActivationCodeController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(ActivationCode::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.activation_code.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.activationCode.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.activationCode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreActivationCodeRequest $request
     *
     * @return mixed
     */
    public function store(StoreActivationCodeRequest $request)
    {
        StoreActivationCodeAction::run($request->validated());
        return redirect(route('admin.activation-code.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('activationCode.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivationCode $activationCode)
    {
        return view('admin.pages.activationCode.show',compact('activationCode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ActivationCode $activationCode
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(ActivationCode $activationCode)
    {
        return view('admin.pages.activationCode.edit',compact('activationCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateActivationCodeRequest $request
     * @param ActivationCode              $activationCode
     *
     * @return mixed
     */
    public function update(UpdateActivationCodeRequest $request, ActivationCode $activationCode)
    {
        UpdateActivationCodeAction::run($activationCode,$request->validated());
        return redirect(route('admin.activation-code.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('activationCode.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ActivationCode $activationCode
     *
     * @return mixed
     */
    public function destroy(ActivationCode $activationCode)
    {
        DeleteActivationCodeAction::run($activationCode);
        return redirect(route('admin.activation-code.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('activationCode.model')]));
    }
}
