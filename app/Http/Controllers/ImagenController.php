<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        return $request->all();
        return $request->file('file');
    }
}
