<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Comment\DeleteCommentAction;
use App\Actions\Comment\StoreCommentAction;
use App\Actions\Comment\UpdateCommentAction;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Comment::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.comment.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.comment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.comment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     *
     * @return mixed
     */
    public function store(StoreCommentRequest $request)
    {
        StoreCommentAction::run($request->validated());
        return redirect(route('admin.comment.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('comment.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('admin.pages.comment.show',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Comment $comment)
    {
        return view('admin.pages.comment.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommentRequest $request
     * @param Comment              $comment
     *
     * @return mixed
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        UpdateCommentAction::run($comment,$request->validated());
        return redirect(route('admin.comment.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('comment.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     *
     * @return mixed
     */
    public function destroy(Comment $comment)
    {
        DeleteCommentAction::run($comment);
        return redirect(route('admin.comment.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('comment.model')]));
    }
}
