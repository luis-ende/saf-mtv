<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMTVController extends Controller
{
    public function indexRolesPermisos(Request $request) 
    {
        return view('admin.roles-permisos-index');
    }
}