<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function ordersList()
    {
        return view('layouts.profile.orders');
    }
}