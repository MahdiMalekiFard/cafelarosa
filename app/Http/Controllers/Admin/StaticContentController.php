<?php

namespace App\Http\Controllers\Admin;

use App\Models\StaticContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StaticContentController
{
    public function view()
    {
        return view('admin.static_content.view');
    }

    public function update(Request $request, $key): RedirectResponse
    {
        $validated = $request->validate([
            'locale' => 'required|string',
            'value'  => 'required|string',
        ]);

        StaticContent::updateOrCreate(
            ['key' => $key, 'locale' => $validated['locale']],
            ['value' => $validated['value']]
        );

        return redirect()->back()->with('success', 'Content updated successfully.');
    }

    public function get($key, $locale)
    {
        return StaticContent::where('key', $key)->where('locale', $locale)->first()?->value;
    }
}
