<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function settings()
    {
        return view('layouts.profile.settings');
    }
}