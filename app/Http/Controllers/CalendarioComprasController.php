<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarioComprasController extends Controller
{
/**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        return view('calendario-compras.index');
    }
}