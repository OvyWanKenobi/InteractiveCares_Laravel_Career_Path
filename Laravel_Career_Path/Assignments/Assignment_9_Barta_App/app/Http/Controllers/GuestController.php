<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;

class GuestController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function loginSubmit(Request $request)
    {

        $validate  = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if ($this->userService->loginUser($validate)) {

            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'login_error' => 'Invalid Email or Password. Try Again.'
        ]);
    }

    public function registerSubmit(UserRegistrationRequest $request)
    {

        $validated = $request->validated();

        try {
            $userCreated = $this->userService->registerUser($validated);

            if ($userCreated) {

           

                return redirect('login')->with('message', 'Registration Successful.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['db_error' => 'Internal Server Error']);
        }

        return back();
    }
}
