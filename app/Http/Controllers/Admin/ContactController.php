<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Contact\DeleteContactAction;
use App\Actions\Contact\StoreContactAction;
use App\Actions\Contact\UpdateContactAction;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Contact::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.contact.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContactRequest $request
     *
     * @return mixed
     */
    public function store(StoreContactRequest $request)
    {
        StoreContactAction::run($request->validated());
        return response()->json(['success' => 'Your message has been sent successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('admin.pages.contact.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $contact
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Contact $contact)
    {
        return view('admin.pages.contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContactRequest $request
     * @param Contact              $contact
     *
     * @return mixed
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        UpdateContactAction::run($contact,$request->validated());
        return redirect(route('admin.contact.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('contact.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     *
     * @return mixed
     */
    public function destroy(Contact $contact)
    {
        DeleteContactAction::run($contact);
        return redirect(route('admin.contact.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('contact.model')]));
    }

    public function contactUs()
    {
        return view('web.pages.contact-us');
    }

    public function storeContactFromWeb(StoreContactRequest $request): JsonResponse
    {
        StoreContactAction::run($request->validated());
        return response()->json(['success' => 'Your message has been sent successfully.']);
    }
}
