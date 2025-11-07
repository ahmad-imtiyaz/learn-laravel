<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HaloController extends Controller
{
    public function index()
    {
        $nama = 'Yazna';
        return view('hello', compact('nama'));
    }
}
