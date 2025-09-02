<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboardController extends BaseWebController
{
    public function index(Request $request)
    {
        return redirect(route('admin.contact.index'));
//        return view('admin.pages.dashboard');
    }
}
