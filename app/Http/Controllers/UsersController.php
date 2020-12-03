<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{


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

    }


    public  function  logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->route('users.login');
    }
}
