<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function settingsSet()
    {
        return view('layouts.profile.settings');
    }
}