<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// Use App\User;
// Use App\Mail\WelcomeAgain;
Use App\Http\Requests\RegistrationForm;

class RegistrationController extends Controller
{
    //
    public function create()
    {
    	return view('registration.create');
    }

    public function store(RegistrationForm $form)
    {
        $form->persist();
    	// Redirect to the home page.
    	return Redirect('/'); // redirect()->home(); though have to explicitly mention in route
    }


}
