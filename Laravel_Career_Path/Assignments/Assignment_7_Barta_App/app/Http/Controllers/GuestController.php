<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class GuestController extends Controller
{
    public function loginSubmit(Request $request)
    {

        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($data)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'login_error' => 'Invalid Email or Password. Try Again.'
        ]);
    }

    public function registerSubmit(UserRegistrationRequest $request)
    {

        // dd($request->all());

        $validate = $request->validated();

        [$fullname, $username, $email, $password] = array_values($validate);

        $nameParts = explode(' ', $fullname);

        $lastname = array_pop($nameParts);
        $firstname = implode(' ', $nameParts);

        // dd($firstname, $lastname);

        try {
            $user = DB::table('users')->insert([
                'fullname' => $fullname,
                'lastname' => $lastname,
                'firstname' => $firstname,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'created_at' => now(),
            ]);

            if ($user) {

                return redirect('login')->with('message', 'Registration Successful.');
            }
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['db_error' => 'Database error: ' . $e->getMessage()]);
        }


        return back();
    }
}
