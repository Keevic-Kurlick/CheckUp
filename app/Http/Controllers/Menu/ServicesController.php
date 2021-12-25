<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServicesController extends Controller
{
    public function servicesList()
    {
        $services = Service::all()->toBase();

        return view('layouts.menu.services', compact('services'));
    }
}
