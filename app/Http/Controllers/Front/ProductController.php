<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        return view('home', [
           
        ]);
    }
    public function index1()
    { 
        $lists = Product::paginate(10);
        $data = [
            'lists' => $lists
        ];
        return view('home', $data);
    }
    public function contact()
    {
        return view('layout.contact', [
           
        ]);
    }

    public function text()
    {
        return view('layout.text', [
           
        ]);
    }
}


