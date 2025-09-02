<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Profile\DeleteProfileAction;
use App\Actions\Profile\StoreProfileAction;
use App\Actions\Profile\UpdatePersonalSettingAction;
use App\Actions\Profile\UpdateProfileAction;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProfileController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Profile::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.profile.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProfileRequest $request
     *
     * @return mixed
     */
    public function store(StoreProfileRequest $request)
    {
        StoreProfileAction::run($request->validated());
        return redirect(route('admin.profile.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('profile.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $user = $profile->user;
        return view('admin.pages.profile.show', compact('profile', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Profile $profile)
    {
        return view('admin.pages.profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileRequest $request
     * @param Profile              $profile
     *
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request, Profile $profile): RedirectResponse
    {
        UpdateProfileAction::run($profile, $request->validated());
        $this->sessionMessage(trans('general.update_success', ['model' => trans('profile.model')]));
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profile $profile
     *
     * @return mixed
     */
    public function destroy(Profile $profile)
    {
        DeleteProfileAction::run($profile);
        return redirect(route('admin.profile.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('profile.model')]));
    }

    public function updatePersonalSetting(Request $request, Profile $profile)
    {
        UpdatePersonalSettingAction::run($profile, $request->all());

        return redirect(route('admin.index'));
    }
}
