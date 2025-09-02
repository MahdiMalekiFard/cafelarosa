<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Comment\StoreCommentAction;
use App\Services\File\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class CoreController extends BaseWebController
{
    public function changeLocale(Request $request, string $lang = 'en'): RedirectResponse
    {
        if (in_array($lang, config('app.supported_locales', []), true)) {
            session(['locale' => $lang]);
            App::setLocale($lang);

            return redirect(route('admin.index'));
        }

        return redirect(route('admin.index'));
    }

    public function tinyMCEImageUpload(): JsonResponse
    {
        $file = request()->file('file');
        $year = Carbon::now()->year;
        $imagePath = "uploads/images/tinyMCE/{$year}/";
        $fileName = $file->getClientOriginalName();
        $file->move(public_path($imagePath), $fileName);
        $imgPath = $imagePath . $fileName;

        return response()->json(['location' => $imgPath]);
    }

    public function dropzone(Request $request): JsonResponse
    {
        $file = request()->file('file');
        $fileName = $file->getClientOriginalName();

        $path = FileService::dropzoneImagePathGenerator();
        $file->move(public_path($path), $fileName);

        return response()->json([
            'name' => $fileName,
            'path' => $path . $fileName,
        ]);
    }

    //    public function addComment(Request $request, StoreCommentAction $storeCommentAction): RedirectResponse
    //    {
    //        $storeCommentAction->handle([
    //            'commentable_id'   => $request->input('commentable_id'),
    //            'parent_id'        => $request->input('parent_id'),
    //            'commentable_type' => $request->input('commentable_type'),
    //            'comment'          => $request->input('body'),
    //        ]);
    //
    //        return redirect()->back();
    //    }
}
