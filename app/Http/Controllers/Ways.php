<?php

namespace App\Http\Controllers;

use App\Way;
use Illuminate\Http\Request;

class Ways extends Controller
{
    public function index()
    {
        return view('ways.index')
            ->with('ways', Way::all());
    }
}
