<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginpost(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email', // Ensures a valid email
            'password' => 'required|min:5|string', // Ensures the password is a string with minimum length 5
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log in the user
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended(route('welcome')); // Redirect to intended route or fallback to welcome
        }

        return redirect()->route('auth.login')->with('error', 'Invalid credentials');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerpost(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email', // Validate as email and ensure uniqueness in the users table
            'password' => 'required|string|min:5', // Password must be at least 5 characters
        ],[
        'name.unique'=>'This name is already taken. Please Choose Another',
        'email.unique'=>'The email is already taken,Please use another'
        
        ]);

        // Save the new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user->save();

        return redirect()->route('auth.login')->with('success', 'Account Created Successfully');
    }


    public function logout(){
        Auth::logout();

        return redirect()->route('auth.login');
    }

}
