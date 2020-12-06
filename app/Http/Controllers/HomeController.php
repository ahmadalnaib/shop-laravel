<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class HomeController extends Controller
{
    public  function index()
    {
        $stores=Store::latest()->simplePaginate(12);
        return view('home',compact('stores'));
    }
}
