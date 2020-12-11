<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceived;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public  function index()
    {
       Mail::to(auth()->user())->send(new OrderReceived);
        $stores=Store::latest()->simplePaginate(12);
        return view('home',compact('stores'));
    }
}
