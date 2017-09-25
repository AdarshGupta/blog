<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    // filters, that is, allows only guest users to sign in and thus already signed in users can't see this page
    // Except logged in users who want to access logout
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create()
    {
    	return view('sessions.create');
    }

    public function store()
    {
        // Attempt to authenticate the user
        if(! auth()->attempt(request(['email', 'password']))) // attempt() method automatically sign in the user
        {
            //If not, redirect the user
            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        }

        //If so, sign them in.

        //Redirect to the home page
        return Redirect('/');
    }

    public function destroy()
    {
        auth()->logout();

        return Redirect('/');
        
    }

}
