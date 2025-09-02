<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Opinion\DeleteOpinionAction;
use App\Actions\Opinion\StoreOpinionAction;
use App\Actions\Opinion\UpdateOpinionAction;
use App\Http\Requests\StoreOpinionRequest;
use App\Http\Requests\UpdateOpinionRequest;
use App\Models\Opinion;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use App\Yajra\Column\ActionColumn;
use App\Yajra\Column\CreatedAtColumn;
use App\Yajra\Column\PublishedColumn;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OpinionController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request, AdvancedSearchFieldsService $searchFieldsService)
    {
        if ($request->ajax()) {
            return Datatables::of(Opinion::query())
                             ->addIndexColumn()
                             ->addColumn('subject', fn($row) => $row->subject)
                             ->addColumn('user_name', fn($row) => $row->user_name)
                             ->addColumn('published', new PublishedColumn)
                             ->addColumn('actions', new ActionColumn('admin.pages.opinion.index_options'))
                             ->addColumn('created_at', new CreatedAtColumn)
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.opinion.index', [
            'filters' => $searchFieldsService->generate(Opinion::class),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.opinion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOpinionRequest $request
     *
     * @return mixed
     */
    public function store(StoreOpinionRequest $request)
    {
        StoreOpinionAction::run($request->validated());
        return redirect(route('admin.opinion.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('opinion.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Opinion $opinion)
    {
        return view('admin.pages.opinion.show', compact('opinion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Opinion $opinion
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Opinion $opinion)
    {
        return view('admin.pages.opinion.edit', compact('opinion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOpinionRequest $request
     * @param Opinion              $opinion
     *
     * @return mixed
     */
    public function update(UpdateOpinionRequest $request, Opinion $opinion)
    {
        UpdateOpinionAction::run($opinion, $request->validated());
        return redirect(route('admin.opinion.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('opinion.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Opinion $opinion
     *
     * @return mixed
     */
    public function destroy(Opinion $opinion)
    {
        DeleteOpinionAction::run($opinion);
        return redirect(route('admin.opinion.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('opinion.model')]));
    }
}
