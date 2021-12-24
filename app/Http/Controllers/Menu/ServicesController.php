<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function servicesList()
    {
        return view('layouts.menu.services');
    }
}
