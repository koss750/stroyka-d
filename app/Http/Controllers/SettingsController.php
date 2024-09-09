<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return Setting::all();
    }

    public function show($label)
    {
        return Setting::where('label', $label)->firstOrFail();
    }

    public function update(Request $request, $label)
    {
        $request->validate([
            'value' => 'required|string',
            'affected_users' => 'sometimes|string',
            'affected_areas' => 'sometimes|string',
        ]);

        $setting = Setting::where('label', $label)->firstOrFail();
        $setting->update($request->only(['value', 'affected_users', 'affected_areas']));

        return $setting;
    }
}