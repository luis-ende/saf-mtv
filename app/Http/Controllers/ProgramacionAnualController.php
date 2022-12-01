<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramacionAnualController extends Controller
{
    public function index(Request $request) 
    {
        return view('programacion-anual');
    }
}