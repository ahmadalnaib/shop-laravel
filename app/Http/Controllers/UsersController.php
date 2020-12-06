<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{


    public  function  account()
    {
           $stores=auth()->user()->stores;
        return view('users.account',compact('stores'));
    }


    public  function  login()
    {
        if(auth()->check())
        {
            return  redirect('/');
        }
        return view('users.login');
    }

    public  function  tryLogin()
    {
        $validatedData=request()->validate([
            'email'=>'required',
            'password'=>'required|min:5',
        ]);
        if(auth()->attempt(['email'=>request()->email,'password'=>request()->password]))
        {
            return redirect()->intended('/');
        } else {
            return  back()->withErrors(['المعلومات خاطئه']);
        }
    }

    public  function create()
    {
        return view('users.register');
    }

    public  function  store()
    {
        $validatedData=request()->validate([
            'name'=>'required|min:5',
            'number'=>'required|min:8:unique:users',
            'email'=>'required|unique:users',
            'password'=>'required|min:5',
            'confirm'=>'required|same:password'
        ]);

        $newUser=new User();
        $newUser->name=request()->name;
        $newUser->number=request()->number;
        $newUser->email=request()->email;
        $newUser->password=Hash::make(request()->password);
        $newUser->email_verified_at=now();
        $newUser->save();

               return redirect()->route('users.login');
    }


    public  function  logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->route('users.login');
    }


    public  function address()
    {
     $address= auth()->user()->address;
     return view('users.address',compact('address'));
    }

    public  function storeAddress()
    {
    $validateData=request()->validate([
        'area'=>'required',
        'block'=>'required',
        'street'=>'required',
        'house'=>'required'
    ]);
    $newArray=[
        'area'=>request()->area,
        'block'=>request()->block,
        'street'=>request()->street,
        'house'=>request()->house,
        'extra'=>request()->extra
    ];
    auth()->user()->address=$newArray;
    auth()->user()->save();
    return redirect()->route('users.account');

    }



    public function edit()
    {
        $user=auth()->user();
     return view('users.edit',compact('user'));
    }

    public  function  update()
    {
        $validatedData=request()->validate([

            'number'=>'required|min:8:unique:users,id,'.auth()->user()->id,
            'email'=>'required|unique:users,id,'.auth()->user()->id,
            'password'=>'required|min:5',
            'confirm'=>'required|same:password'
        ]);

        $user=auth()->user();
        $user->number=request()->number;
        $user->email=request()->email;
        $user->password=Hash::make(request()->password);
        $user->email_verified_at=now();
        $user->save();

        return redirect()->back();
    }
}
