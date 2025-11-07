<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;

class HewanController extends Controller
{
    public function index()
    {
        $datahewan = Hewan::all();
        return view('hewan', compact('datahewan'));
    }
}
