<?php

namespace App\Http\Requests;
Use App\User;
Use App\Mail\WelcomeAgain;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Anyone can make the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Validate the form
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'  // checks for password_confirmation == password
        ];
    }

    public function persist()
    {
        //Create and save the user
        //$this->only is same as calling request method
        $user = User::create(
            $this->only(['name', 'email', 'password'])
        );
        // $user = User::create([
        //     'name' =>request('name'),
        //     'email' => request('email'),
        //     'password' => bcrypt(request('password'))
        // ]);

        //Sign in the user
        auth()->login($user);

        \Mail::to($user)->send(new WelcomeAgain($user));
    }
}
