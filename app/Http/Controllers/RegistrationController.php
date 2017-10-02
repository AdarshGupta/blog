<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Mail\WelcomeAgain;

class RegistrationController extends Controller
{
    //
    public function create()
    {
    	return view('registration.create');
    }

    public function store()
    {
    	//Validate the form
    	$this->validate(request(), [
    		'name' => 'required',
    		'email' => 'required|unique:users|email',
    		'password' => 'required|confirmed'  // checks for password_confirmation == password
    	]);

    	//Create and save the user
    	$user = User::create([
            'name' =>request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

    	//Sign in the user
    	auth()->login($user);

        \Mail::to($user)->send(new WelcomeAgain($user));

    	// Redirect to the home page.
    	return Redirect('/'); // redirect()->home(); though have to explicitly mention in route
    }


}
