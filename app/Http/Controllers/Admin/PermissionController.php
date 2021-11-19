<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        
        return view('admin.permission.lists');
    } 
    
  
    public function insert(Request $request)
    {
        
        return view('admin.permission.insert');
    } 
   

}


