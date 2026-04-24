<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name'    => 'nullable|string|max:255',
            'site_email'   => 'nullable|email',
            'site_phone'   => 'nullable|string|max:30',
            'site_address' => 'nullable|string|max:500',
            'currency'     => 'nullable|string|max:10',
        ]);

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings')->with('success', 'Settings saved successfully.');
    }
}
