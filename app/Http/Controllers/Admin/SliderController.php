<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Slider\DeleteSliderAction;
use App\Actions\Slider\StoreSliderAction;
use App\Actions\Slider\UpdateSliderAction;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use App\Yajra\Column\CreatedAtColumn;
use App\Yajra\Column\TitleColumn;
use App\Yajra\Filter\TitleFilter;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Slider::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.slider.index_options', ['row' => $row]);
                             })
                             ->addColumn('title', new TitleColumn)
                             ->filterColumn('title', new TitleFilter)
                             ->addColumn('created_at', new CreatedAtColumn)
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSliderRequest $request
     *
     * @return mixed
     */
    public function store(StoreSliderRequest $request)
    {
        StoreSliderAction::run($request->validated());
        return redirect(route('admin.slider.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('slider.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return view('admin.pages.slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Slider $slider)
    {
        return view('admin.pages.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSliderRequest $request
     * @param Slider              $slider
     *
     * @return mixed
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        UpdateSliderAction::run($slider, $request->validated());
        return redirect(route('admin.slider.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('slider.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     *
     * @return mixed
     */
    public function destroy(Slider $slider)
    {
        DeleteSliderAction::run($slider);
        return redirect(route('admin.slider.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('slider.model')]));
    }
}
