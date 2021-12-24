<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

class DocumentsController extends Controller
{
    public function documentsList()
    {
        return view('layouts.profile.documents');
    }
}